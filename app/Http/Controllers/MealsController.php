<?php

namespace App\Http\Controllers;

use App\Domain\Meal\Meal;
use App\Domain\Meal\Requests\CreateMealRequest;
use App\Domain\Meal\Requests\UpdateMealRequest;
use App\Services\MealsService;
use Illuminate\Http\Response;

class MealsController
{
    private MealsService $service;

    public function __construct(MealsService $service)
    {
        $this->service = $service;
    }

    // TODO: обрабатывать ошибки и отправлять ответ
    public function create(CreateMealRequest $request): Response
    {
        $meal = new Meal();
        $meal->fill($request->validated());

        $meal = $this->service->updateOrCreate($meal);

        return new Response([
            'id' => $meal->getAttribute('id'),
        ], 201);
    }

    // TODO: обрабатывать ошибки и отправлять ответ
    public function update(UpdateMealRequest $request): Response
    {
        $meal = Meal::find($request->post('id'));
        $meal->fill($request->validated());
        $meal = $this->service->updateOrCreate($meal);

        return new Response([
            'updated' => $meal->getDirty()
        ], 200);
    }

    public function delete(int $id): Response
    {
        $meal = Meal::find($id);
        if ($meal === null) {
            return new Response(['message' => 'Блюдо не найдено'], 404);
        }

        if ($meal->delete()) {
            return new Response(['message' => "Блюдо $id удалено"], 200);
        }

        return new Response(['message' => "Не удалось удалить блюдо $id"], 500);
    }
}
