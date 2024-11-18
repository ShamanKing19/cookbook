<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    protected $table = 'instruments';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
