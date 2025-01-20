<?php

namespace App\Orchid\Layouts\Meals;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MealsListLayout extends Table
{
    protected $target = 'meals';

    protected function columns(): iterable
    {
        return [
            TD::make('id'),
            TD::make('name'),
        ];
    }
}
