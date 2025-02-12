<?php

namespace App\Domain\Meal;

use App\Domain\Recipe\Recipe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Meal extends Model
{
    use AsSource;

    protected $table = 'meals';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public int $id;
    public string $name;
    public string $slug;

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class, 'meal_id', 'id');
    }
}
