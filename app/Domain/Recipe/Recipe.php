<?php

namespace App\Domain\Recipe;

use App\Domain\Meal\Meal;
use App\Models\Ingredient;
use App\Models\Instrument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Screen\AsSource;

class Recipe extends Model
{
    use AsSource;

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

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'recipes_ingredients', 'recipe_id', 'id');
    }
}