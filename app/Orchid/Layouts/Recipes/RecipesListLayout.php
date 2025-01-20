<?php

namespace App\Orchid\Layouts\Recipes;

use App\Domain\Recipe\Recipe;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RecipesListLayout extends Table
{
    protected $target = 'recipes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'id'),
            TD::make('meal_id', 'Блюдо')
                ->render(fn (Recipe $recipe) => $recipe->meal->getAttribute('name')),
//                ->render(fn (Recipe $recipe) => Link::make($recipe->meal->getAttribute('name'))->route('meals.edit', $recipe->meal)), // TODO: Сделать ссылку на блюда
            TD::make('description'),

        ];
    }
}
