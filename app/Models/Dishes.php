<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dishes extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function restaurant()
    {
        return $this->belongsTo(Restaurants::class);
    }
    public function meals()
    {
        return $this->belongsToMany(Meals::class, 'available_meals');
    }
}
