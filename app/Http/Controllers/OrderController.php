<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Meals\MealsRepositoryInterface;
use App\Repositories\Restaurants\RestaurantsRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{	
	protected $mealsRepo;
    protected $restaurantsRepo;
    protected $orderRepo;

    public function __construct(
    	MealsRepositoryInterface $mealsRepo,
        RestaurantsRepositoryInterface $restaurantsRepo,
        OrderRepositoryInterface $orderRepo
    ){
        $this->mealsRepo = $mealsRepo;
        $this->restaurantsRepo = $restaurantsRepo;
        $this->orderRepo = $orderRepo;
    }

    public function index(){
    	$meals = $this->mealsRepo->getAll();
    	$restaurants = $this->restaurantsRepo->getAll();
        return view('order', compact('meals', 'restaurants'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $this->orderRepo->create($request->all());

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Save order success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => true,
                'message' => 'Save order error'
            ]);
        }
        return $request; 
    }
}
