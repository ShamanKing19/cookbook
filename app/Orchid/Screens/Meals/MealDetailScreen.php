<?php

namespace App\Orchid\Screens\Meals;

use App\Domain\Meal\Meal;
use App\Domain\Meal\MealsRepository;
use App\Domain\Meal\Requests\CreateMealRequest;
use App\Domain\Meal\Requests\UpdateMealRequest;
use App\Http\Controllers\MealsController;
use App\Orchid\Layouts\Meals\MealDetailLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class MealDetailScreen extends Screen
{
    private ?Meal $meal = null;
    private bool $exists = false;

    public function __construct(
        public MealsRepository $repository,
        public MealsController $apiController
    ) {
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
                ->route('api.meals.delete', ['id' => $this->meal->getAttribute('id')])
                ->icon(config('admin_ui.delete_icon'));
        }
        $buttons[] = Button::make('Сохранить')
//            ->route($this->exists ? 'api.meals.update' : 'api.meals.create')
            ->method($this->exists ? 'update' : 'create')
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

    public function create(CreateMealRequest $request)
    {
        $response = $this->apiController->create($request);
        if ($response->isSuccessful()) {
            Toast::success('Блюдо создано!');

            return redirect(route('meals.detail', ['id' => $response->getOriginalContent()['id']]));
        }

        Toast::error('Не удалось создать блюдо');
    }

    public function update(UpdateMealRequest $request)
    {
        $response = $this->apiController->update($request);
        if ($response->isSuccessful()) {
            Toast::success('Блюдо обновлено!');

            return redirect(route('meals.detail', ['id' => $request->get('id')]));
        }

        Toast::error('Не удалось обновить блюдо');
    }
}
