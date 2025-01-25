<?php

namespace App\Domain\Recipe;

class RecipesService
{
    public function __construct(
        private readonly RecipesRepository $repository
    ) {
    }

    public function updateOrCreate(Recipe $recipe)
    {
        $result = $this->repository->save($recipe);
        if ($result) {
            return $recipe->refresh();
        }

        $slug = $recipe->getAttribute('slug');

        throw new \RuntimeException($recipe, "Не удалось создать рецепт \"$slug\"");
    }

}