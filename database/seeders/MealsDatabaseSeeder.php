<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meals;

class MealsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meals::insert([
        	["name" => "breakfast"], 
        	["name" => "lunch"],
        	["name" => "dinner"]
        ]);
    }
}
