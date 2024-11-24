<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MealType extends Model
{
    protected $table = 'meal_types';

    protected $fillable = [
        'name'
    ];

    public function recipe(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_meal_types', 'meal_type_id', 'meal_id');
    }
}
