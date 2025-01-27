<?php

namespace App\Domain\Meal;

use App\Domain\Meal\Requests\CreateMealRequest;
use App\Domain\Meal\Requests\UpdateMealRequest;
use App\Exceptions\ModelNotSavedException;
use Illuminate\Http\Response;

class MealsController
{
    private MealsService $service;

    public function __construct(MealsService $service)
    {
        $this->service = $service;
    }

    public function create(CreateMealRequest $request): Response
    {
        $meal = new Meal();
        $meal->fill($request->validated());

        try {
            $meal = $this->service->updateOrCreate($meal);
        } catch (ModelNotSavedException $e) {
            return new Response(['message' => $e->getMessage()], 500);
        }

        return new Response([
            'id' => $meal->getAttribute('id'),
        ], 201);
    }

    // TODO: обрабатывать ошибки и отправлять ответ
    public function update(UpdateMealRequest $request): Response
    {
        $meal = Meal::find($request->post('id'));
        $meal->fill($request->validated());
        try {
            $meal = $this->service->updateOrCreate($meal);
        } catch (ModelNotSavedException $e) {
            return new Response(['message' => $e->getMessage()], 500);
        }

        return new Response(['updated' => $meal->getDirty()], 200);
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
