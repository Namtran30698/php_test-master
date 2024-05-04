<?php
namespace App\Repositories\Meals;

use App\Models\Meals;
use App\Repositories\BaseRepository;

class MealsRepository extends BaseRepository implements MealsRepositoryInterface
{
    public function getModel()
    {
        return Meals::class;
    }
}
