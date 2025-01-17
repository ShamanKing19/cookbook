<?php

namespace App\Domain\Recipe;

class RecipesRepository
{
    public function getAll()
    {
        return Recipe::all();
    }
}