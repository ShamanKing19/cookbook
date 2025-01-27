<?php

namespace App\Domain\Recipe;

use App\Exceptions\ModelNotSavedException;

class RecipesService
{
    public function __construct(
        private readonly RecipesRepository $repository
    ) {
    }

    /**
     * Создание или обновление рецепта
     *
     * @param Recipe $recipe
     *
     * @return Recipe
     * @throws ModelNotSavedException
     */
    public function updateOrCreate(Recipe $recipe): Recipe
    {
        $result = $this->repository->save($recipe);
        if ($result) {
            return $recipe->refresh();
        }

        $slug = $recipe->getAttribute('slug');

        throw new ModelNotSavedException($recipe, "Не удалось создать рецепт \"$slug\"");
    }

}