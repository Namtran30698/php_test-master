<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Restaurants;
use App\Models\Meals;
use App\Models\Dishes;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {    
        $this->call(MealsDatabaseSeeder::class);
        $data = file_get_contents(storage_path('app/public/data/dishes.json'));
		$dishes = json_decode($data, true);
		foreach ($dishes["dishes"] as $key => $dish) {
			$restaurant = Restaurants::where("name", $dish["restaurant"])->first();
            if(is_null($restaurant)) {
                $restaurant = Restaurants::create(["name"=> $dish["restaurant"]]);
            }
            $availableMeals = Meals::whereIn("name", $dish["availableMeals"])->pluck('id');

            $createdDish = Dishes::create([
                "name" => $dish["name"],
                "restaurant_id" => $restaurant->id
            ]);

            $createdDish->meals()->attach($availableMeals);

		}
    }
}
