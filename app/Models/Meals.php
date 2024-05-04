<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function dishes()
    {
       return $this->belongsToMany(Dishes::class, 'available_meals');
    }
}
