<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meal extends Model
{
    protected $table = 'meals';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class, 'meal_id', 'id');
    }
}