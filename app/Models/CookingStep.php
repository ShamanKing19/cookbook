<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookingStep extends Model
{
    protected $table = 'cooking_steps';
    protected $fillable = [
        'recipe_id',
        'description'
    ];
}
