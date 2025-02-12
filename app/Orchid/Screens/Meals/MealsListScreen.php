<?php

namespace App\Orchid\Screens\Meals;

use App\Domain\Meal\MealsRepository;
use App\Orchid\Layouts\Meals\MealsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class MealsListScreen extends Screen
{
    private MealsRepository $repository;

    public function __construct(MealsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function query(): iterable
    {
        return [
            'meals' => $this->repository->getAllPaginated()
        ];
    }

    public function name(): ?string
    {
        return 'Блюда';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')
                ->route('meals.create')
                ->icon(config('admin_ui.create_icon'))
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            MealsListLayout::class
        ];
    }
}
