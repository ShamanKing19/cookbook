<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Национальная кухня
 */
class Cuisine extends Model
{
    protected $table = 'cuisines';
    protected $fillable = [
        'name',
        'description'
    ];
}
