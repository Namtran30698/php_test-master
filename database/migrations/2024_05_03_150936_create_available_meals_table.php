<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dishes_id')->constrained('dishes');
            $table->foreignId('meals_id')->constrained('meals');
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
        Schema::table('available_meals', function (Blueprint $table) {
            Schema::dropIfExists('available_meals');
        });
    }
}
