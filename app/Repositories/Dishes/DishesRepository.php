<?php
namespace App\Repositories\Dishes;

use App\Models\Dishes;
use App\Repositories\BaseRepository;

class DishesRepository extends BaseRepository implements DishesRepositoryInterface
{
    public function getModel()
    {
        return Dishes::class;
    }

    public function getDishesByMealAndRestaurant($mealId, $restaurantId)
    {	
    	$dishes = $this->model->select(['id', 'name']);
    	if(!is_null($mealId)) {
    		$dishes->whereHas('meals', function ($query) use ($mealId) {
		        $query->where('meals.id', $mealId);
		    });
    	}

    	if(!is_null($restaurantId)) {
    		$dishes->where('restaurant_id', $restaurantId);
    	}

    	return $dishes->get();
    }
}
