<?php
namespace App\Repositories\Restaurants;

use App\Models\Restaurants;
use App\Repositories\BaseRepository;

class RestaurantsRepository extends BaseRepository implements RestaurantsRepositoryInterface
{
    public function getModel()
    {
        return Restaurants::class;
    }
}
