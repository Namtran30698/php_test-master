<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Meals\MealsRepositoryInterface::class,
            \App\Repositories\Meals\MealsRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Restaurants\RestaurantsRepositoryInterface::class,
            \App\Repositories\Restaurants\RestaurantsRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Dishes\DishesRepositoryInterface::class,
            \App\Repositories\Restaurants\DishesRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
