<?php

namespace App\Domain\Recipe;

use Illuminate\Pagination\LengthAwarePaginator;

class RecipesRepository
{
    public function getAll(): LengthAwarePaginator
    {
        return Recipe::paginate();
    }

    public function getById(int $id): ?Recipe
    {
        return Recipe::find($id);
    }

    public function save(Recipe $recipe): bool
    {
        return $recipe->save();
    }
}