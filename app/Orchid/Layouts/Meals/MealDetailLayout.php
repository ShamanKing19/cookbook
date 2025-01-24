<?php

namespace App\Orchid\Layouts\Meals;

use App\Domain\Meal\Meal;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;

class MealDetailLayout extends Rows
{
    /**
     * @return Field[]
     */
    protected function fields(): iterable
    {
        /** @var Meal|null $meal */
        $meal = $this->query['meal'];

        return [
            Input::make('id')
                ->readonly()
                ->title('id')
                ->horizontal()
                ->value($meal?->getAttribute('id')),
            Input::make('name')
                ->title('Название')
                ->horizontal()
                ->type('text')
                ->maxlength(config('constants.max_slug_length'))
                ->required()
                ->value($meal?->getAttribute('name')),
            Input::make('slug')
                ->title('Символьный код')
                ->horizontal()
                ->type('text')
                ->maxlength(config('constants.max_slug_length'))
                ->required()
                ->value($meal?->getAttribute('slug')),
        ];
    }
}
