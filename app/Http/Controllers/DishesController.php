<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Dishes\DishesRepositoryInterface;

class DishesController extends Controller
{
    protected $dishesRepo;

    public function __construct(DishesRepositoryInterface $dishesRepo){
        $this->dishesRepo = $dishesRepo;
    }

    public function index(Request $request){
    	try {
    		$dishes = $this->dishesRepo->getDishesByMealAndRestaurant($request->mealId, $request->restaurantId);
    		return response()->json([
                'success' => true,
                'message' => '',
                'data' => $dishes,
            ]);;
    	} catch (Exception $e) {
    		return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ]);;
    	}
    }
}
