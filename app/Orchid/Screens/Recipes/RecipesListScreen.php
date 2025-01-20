<?php

namespace App\Orchid\Screens\Recipes;

use App\Domain\Recipe\RecipesRepository;
use App\Orchid\Layouts\Recipes\RecipesListLayout;
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

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Рецепты блюд';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            RecipesListLayout::class
        ];
    }
}
