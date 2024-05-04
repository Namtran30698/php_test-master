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
}
