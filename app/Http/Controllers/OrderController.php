<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Meals\MealsRepositoryInterface;
use App\Repositories\Restaurants\RestaurantsRepositoryInterface;

class OrderController extends Controller
{	
	protected $mealsRepo;
    protected $restaurantsRepo;

    public function __construct(
    	MealsRepositoryInterface $mealsRepo,
        RestaurantsRepositoryInterface $restaurantsRepo
    ){
        $this->mealsRepo = $mealsRepo;
        $this->restaurantsRepo = $restaurantsRepo;
    }

    public function index(){
    	$meals = $this->mealsRepo->getAll();
    	$restaurants = $this->restaurantsRepo->getAll();
        return view('order', compact('meals', 'restaurants'));
    }
}
