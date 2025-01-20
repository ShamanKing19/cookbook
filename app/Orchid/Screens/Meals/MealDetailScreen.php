<?php

namespace App\Orchid\Screens\Meals;

use App\Domain\Meal\Meal;
use App\Domain\Meal\MealsRepository;
use App\Orchid\Layouts\Meals\MealDetailLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class MealDetailScreen extends Screen
{
    private MealsRepository $repository;
    private ?Meal $meal;
    private bool $exists;

    public function __construct(MealsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function query(?int $id = null): iterable
    {
        $this->meal = isset($id) ? $this->repository->getById($id) : null;
        $this->exists = isset($this->meal);

        return [
            'meal' => $this->meal ?? null
        ];
    }

    public function name(): ?string
    {
        return $this->exists ? 'Изменение блюда "' . $this->meal->getAttribute('name') . '"' : 'Создание блюда';
    }

    /**
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        $buttons = [];
        if ($this->exists) {
            $buttons[] = Button::make('Удалить')
//                ->route('') // TODO: Отправлять запрос на api
                ->icon(config('admin_ui.delete_icon'));
        }
        $buttons[] = Button::make('Сохранить')
//                ->route('') // TODO: Отправлять запрос на api
            ->icon($this->exists ? config('admin_ui.save_icon') : config('admin_ui.create_icon'));

        return $buttons;
    }

    /**
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            MealDetailLayout::class
        ];
    }
}