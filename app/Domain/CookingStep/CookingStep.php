<?php

namespace App\Domain\CookingStep;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class CookingStep extends Model
{
    use AsSource;

    protected $table = 'cooking_steps';
    protected $fillable = [
        'recipe_id',
        'description',
        'slug'
    ];
}
