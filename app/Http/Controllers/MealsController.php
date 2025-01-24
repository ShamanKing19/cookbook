<?php

namespace App\Http\Controllers;

use App\Domain\Meal\Meal;
use App\Domain\Meal\Requests\CreateMealRequest;
use App\Domain\Meal\Requests\UpdateMealRequest;
use App\Services\MealsService;
use Illuminate\Http\Request;
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

        $meal = $this->service->updateOrCreate($meal);

        return new Response([
            'id' => $meal->getAttribute('id'),
        ], 201);
    }

    public function update(UpdateMealRequest $request)
    {
        $fields = $request->validated();
        $meal = Meal::find($fields['id']);

        return $this->service->updateOrCreate($meal);
    }

    public function delete(Request $request)
    {

    }
}
