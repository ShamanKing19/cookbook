<?php

namespace App\Domain\Recipe;

use Illuminate\Pagination\LengthAwarePaginator;

class RecipesRepository
{
    public function getAll(): LengthAwarePaginator
    {
        return Recipe::paginate();
    }
}