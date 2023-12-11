<?php

namespace App\Http\Controllers;
use App\Models\Pizza;
use App\Models\Ingredient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::with(['ingredients'])->paginate(10);
        
        return response()->json($pizzas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "ingredients" => "required"
        ]);

        DB::beginTransaction();

        try {
            $pizza = new Pizza();
            $pizza->name = $request->name;
            //$pizza->fecha = date("Y-m-d H:i:s");
            //$pizza->observacion = "SIN OBSERVACIONES";
            
            $total = $this->calcularPrecio($request->ingredients);
            $pizza->totalPrice = $total;

            $pizza->save();
            // asignar los ingredientes a la pizza
            $ingredients = $request->ingredients;
            foreach ($ingredients as $ingredient) {
                $ingredient_id = $ingredient["ingredient_id"];
                //$order = $ingredient["order"];
                //$pizza->ingredients()->attach($ingredient_id, ["order" => $order]);
                $pizza->ingredients()->attach($ingredient_id);
            }

            DB::commit();
            // all good
            return response()->json(["message" => "pizza registrada"], 201);

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json(["message" => "Error al Registrar el pizza", "error" => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        $pizza->ingredients()->detach();
        $pizza->delete();

        return response()->json(["message" => "Pizza as been deleted"], 200);

    }


    public function calcularPrecio($ingredients)
    {

        $total = 0;

        foreach($ingredients as $ingredient){

            //$total = $ingredient['ingredient_id'];
            $ing = Ingredient::find($ingredient['ingredient_id']);
            $total = $total + $ing["price"];

        }

        $totalPizzaPrice = $total*1.5;

        return $totalPizzaPrice;
    }

}
