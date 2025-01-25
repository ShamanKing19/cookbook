<?php

namespace App\Orchid\Layouts\Recipes;

use App\Domain\Recipe\Recipe;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RecipesListLayout extends Table
{
    protected $target = 'recipes';

    /**
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'id')
                ->render(function (Recipe $recipe) {
                    $id = $recipe->getAttribute('id');

                    return Link::make($id)->route('recipes.detail', ['id' => $id]);
                }),
            TD::make('meal_id', 'Блюдо')
                ->render(function (Recipe $recipe) {
                    return Link::make($recipe->meal->getAttribute('name'))
                        ->route('meals.detail', $recipe->meal->getAttribute('id'));
                }),
            TD::make('description'),

        ];
    }
}
