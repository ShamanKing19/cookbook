<?php

namespace App\Orchid\Layouts\CookingSteps;

use App\Domain\CookingStep\CookingStep;
use Illuminate\Support\Str;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CookingStepsLayout extends Table
{
    protected $target = 'cooking_steps';

    protected function columns(): iterable
    {
        return [
            'id' => TD::make('id', 'id'),
            'slug' => TD::make('slug', 'Символьный код'),
            'description' => TD::make('description', 'Описание')->render(function (CookingStep $step) {
                return Str::limit($step->getAttribute('description'), 30);
            })
        ];
    }
}
