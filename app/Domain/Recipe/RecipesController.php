<?php

namespace App\Domain\Recipe;

use App\Domain\Recipe\Requests\CreateRecipeRequest;
use App\Domain\Recipe\Requests\UpdateRecipeRequest;
use App\Exceptions\ModelNotSavedException;
use Illuminate\Http\Response;

class RecipesController
{
    public function __construct(
        private readonly RecipesService $service
    ) {
    }

    public function create(CreateRecipeRequest $request): Response
    {
        $recipe = new Recipe($request->validated());
        try {
            if ($recipe = $this->service->updateOrCreate($recipe)) {
                return new Response([
                    'id' => $recipe
                ]);
            }
        } catch (ModelNotSavedException $e) {
            return new Response(['message' => $e->getMessage()], 500);
        }

        return new Response(['message' => 'Не удалось создать рецепт']);
    }

    public function update(UpdateRecipeRequest $request): Response
    {
        $recipe = Recipe::find($request->post('id'));
        $recipe->fill($request->validated());
        try {
            $recipe = $this->service->updateOrCreate($recipe);
        } catch (ModelNotSavedException $e) {
            return new Response(['message' => $e->getMessage()], 500);
        }

        return new Response(['updated' => $recipe->getDirty()], 200);
    }

    public function delete(int $id): Response
    {
        $recipe = Recipe::find($id);
        if ($recipe === null) {
            return new Response(['message' => 'Рецепт не найден'], 404);
        }

        if ($recipe->delete()) {
            return new Response(['message' => "Рецепт $id удален"], 200);
        }

        return new Response(['message' => "Не удалось удалить рецепт $id"], 500);
    }
}
