<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_ingredient', function (Blueprint $table) {
            $table->id();
            $table->decimal("order", 10, 0)->default(0);

            $table->bigInteger("pizza_id")->unsigned();
            $table->bigInteger("ingredient_id")->unsigned();

            $table->foreign("pizza_id")->references("id")->on("pizzas");
            $table->foreign("ingredient_id")->references("id")->on("ingredients");

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_ingredient');
    }
};
