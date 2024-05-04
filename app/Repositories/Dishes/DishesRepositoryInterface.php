<?php
namespace App\Repositories\Dishes;

use App\Repositories\RepositoryInterface;

interface DishesRepositoryInterface extends RepositoryInterface
{
	public function getDishesByMealAndRestaurant($mealId, $restaurantId);
}
