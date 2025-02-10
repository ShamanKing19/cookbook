<?php

namespace App\Orchid\Screens\Recipes;

use App\Domain\Recipe\Recipe;
use App\Domain\Recipe\RecipesController;
use App\Domain\Recipe\RecipesRepository;
use App\Domain\Recipe\Requests\CreateRecipeRequest;
use App\Domain\Recipe\Requests\UpdateRecipeRequest;
use App\Orchid\Layouts\CookingSteps\CookingStepsLayout;
use App\Orchid\Layouts\Recipes\RecipeDetailLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class RecipeDetailScreen extends Screen
{
    private ?Recipe $recipe = null;
    private bool $exists = false;

    public function __construct(
        private readonly RecipesController $apiController,
        private readonly RecipesRepository $repository
    ) {
    }

    public function query(?int $id = null): iterable
    {
        $this->recipe = isset($id) ? $this->repository->getById($id) : null;
        $this->exists = isset($this->recipe);

        return [
            'recipe' => $this->recipe,
            'cooking_steps' => $this->recipe->cookingSteps()->get()
        ];
    }

    public function name(): string
    {
        return $this->exists ? 'Изменение рецепта' : 'Создание рецепта';
    }

    /**
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        $buttons = [];
        if ($this->exists) {
            $buttons[] = Button::make('Удалить')
                ->method('delete')
                ->icon(config('admin_ui.delete_icon'));
        }

        $buttons[] = Button::make('Сохранить')
            ->method($this->exists ? 'update' : 'create')
            ->icon($this->exists ? config('admin_ui.save_icon') : config('admin_ui.create_icon'));

        return $buttons;
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            RecipeDetailLayout::class,
            CookingStepsLayout::class
        ];
    }

    public function create(CreateRecipeRequest $request)
    {
        $response = $this->apiController->create($request);
        if ($response->isSuccessful()) {
            Toast::success('Рецепт создан!');

            return redirect(route('recipes.detail', ['id' => $response->getOriginalContent()['id']]));
        }

        Toast::error('Не удалось создать рецепт');

        return null;
    }

    public function update(UpdateRecipeRequest $request)
    {
        $response = $this->apiController->update($request);
        $id = (int)$request->get('id');
        if ($response->isSuccessful()) {
            Toast::success("Рецепт с id=\"$id\" обновлено!");

            return redirect(route('recipes.detail', ['id' => $id]));
        }

        Toast::error("Не удалось обновить рецепт \"$id\"");

        return null;
    }

    public function delete(Request $request)
    {
        $id = (int)$request->get('id');
        $response = $this->apiController->delete($id);
        if ($response->isSuccessful()) {
            Toast::success("Рецепт с id=\"$id\" удалено");

            return redirect(route('recipes.list'));
        }

        Toast::error("Не удалось удалить рецепт с id=\"$id\"");

        return null;
    }
}
