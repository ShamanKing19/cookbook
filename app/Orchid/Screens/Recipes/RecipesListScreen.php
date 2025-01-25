<?php

namespace App\Orchid\Screens\Recipes;

use App\Domain\Recipe\RecipesRepository;
use App\Orchid\Layouts\Recipes\RecipesListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RecipesListScreen extends Screen
{
    private RecipesRepository $repository;

    public function __construct(RecipesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function query(): iterable
    {
        return [
            'recipes' => $this->repository->getAll()
        ];
    }

    public function name(): ?string
    {
        return 'Рецепты блюд';
    }

    /**
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить рецепт')
                ->icon(config('admin_ui.create_icon'))
                ->route('recipes.create')
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            RecipesListLayout::class
        ];
    }
}
