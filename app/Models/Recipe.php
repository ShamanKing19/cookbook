<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    protected $table = 'recipes';
    protected $fillable = [
        'meal_id',
        'description',
        'cooking_time',
        'author_id'
    ];

    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }

    public function instruments(): BelongsToMany
    {
        return $this->belongsToMany(Instrument::class, 'recipes_instruments' ,'meal_id', 'id');
    }
}
