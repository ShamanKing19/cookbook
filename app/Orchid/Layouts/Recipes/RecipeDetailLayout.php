<?php

namespace App\Orchid\Layouts\Recipes;

use App\Domain\Meal\Meal;
use App\Domain\Recipe\Recipe;
use App\Models\User;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Layouts\Rows;

class RecipeDetailLayout extends Rows
{
    protected $title;

    protected function fields(): iterable
    {
        /** @var Recipe|null $recipe */
        $recipe = $this->query['recipe'];

        /** @var Meal|null $meal */
        $meal = $this->query['meal'];

        return [
            Input::make('id')
                ->title('id')
                ->readonly()
                ->value($recipe?->getAttribute('id'))
                ->horizontal(),
            Input::make('created_at')
                ->title('Дата создания')
                ->readonly()
                ->value($recipe?->getAttribute('created_at'))
                ->horizontal(),
            Input::make('updated_at')
                ->title('Дата обновления')
                ->readonly()
                ->value($recipe?->getAttribute('updated_at'))
                ->horizontal(),
            Select::make('meal_id')
                ->title('Блюдо')
                ->fromModel(Meal::class, 'name')
                ->empty('Не выбрано')
                ->required($recipe === null)
                ->value($recipe?->getAttribute('meal_id'))
                ->horizontal(),
            Input::make('slug')
                ->title('Символьный код')
                ->horizontal()
                ->type('text')
                ->maxlength(config('constants.max_slug_length'))
                ->required()
                ->value($recipe?->getAttribute('slug')),
            Input::make('cooking_time')
                ->title('Время готовки (в минутах)')
                ->type('number')
                ->min(0)
                ->max(config('constants.max_int_value'))
                ->value($recipe?->getAttribute('cooking_time'))
                ->horizontal(),
            Select::make('author_id')
                ->title('Автор рецепта')
                ->fromModel(User::class, 'name')
                ->value($recipe?->getAttribute('author_id'))
                ->empty('Не выбрано')
                ->horizontal(),
            SimpleMDE::make('description')
                ->title('Описание')
                ->value($recipe?->getAttribute('description'))
                ->horizontal(),
        ];
    }
}
