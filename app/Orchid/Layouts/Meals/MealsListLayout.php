<?php

namespace App\Orchid\Layouts\Meals;

use App\Domain\Meal\Meal;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MealsListLayout extends Table
{
    protected $target = 'meals';

    protected function columns(): iterable
    {
        return [
            TD::make('id')->render(function (Meal $meal) {
                $id = $meal->getAttribute('id');

                return Link::make($id)->route('meals.detail', ['id' => $id]);
            }),
            TD::make('name')->render(function (Meal $meal) {
                return Link::make($meal->getAttribute('name'))->route('meals.detail', [
                    'id' => $meal->getAttribute('id')
                ]);
            }),
        ];
    }
}
