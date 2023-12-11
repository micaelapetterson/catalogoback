<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::get();

        return response()->json($ingredients, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "name"=> "required",
            "price"=> "required"
        ]);

        // guardar
        $ing = new Ingredient();
        $ing->name = $request->name;
        $ing->price = $request->price;
        $ing->save();

        return response()->json(["message" => "Ingredient Registrado"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $ingredient = Ingredient::find($id);

        return response()->json($ingredient, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // validar
        $request->validate([
            "name"=> "required|unique:ingredients,name,$id"
        ]);

        $cat = Ingredient::find($id);
        $cat->name = $request->name;
        $cat->price = $request->price;
        $cat->update();

        return response()->json(["message" => "Ingredient Modificada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ing = Ingredient::find($id);
        $ing->delete();

        return response()->json(["message" => "Ingrediente Eliminada"], 200);
    }
}
