<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredient = new Ingredient();
        $ingredient->name = "Tomato";
        $ingredient->price = 0.5;
        $ingredient->save(); 
        
        $ingredient = new Ingredient();
        $ingredient->name = "Sliced Mushrooms";
        $ingredient->price = 0.5;
        $ingredient->save(); 

        $ingredient = new Ingredient();
        $ingredient->name = "Feta Cheese";
        $ingredient->price = 1.0;
        $ingredient->save(); 

        $ingredient = new Ingredient();
        $ingredient->name = "Sausages";
        $ingredient->price = 1.0;
        $ingredient->save(); 

        $ingredient = new Ingredient();
        $ingredient->name = "Sliced Onion";
        $ingredient->price = 0.5;
        $ingredient->save(); 

        $ingredient = new Ingredient();
        $ingredient->name = "Mozzarella Cheese";
        $ingredient->price = 0.5;
        $ingredient->save(); 

        $ingredient = new Ingredient();
        $ingredient->name = "Oregano";
        $ingredient->price = 1.0;
        $ingredient->save(); 

        $ingredient = new Ingredient();
        $ingredient->name = "Bacon";
        $ingredient->price = 0.5;
        $ingredient->save(); 
    }
}
