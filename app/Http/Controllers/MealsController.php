<?php

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Http\Requests\CreateOrUpdateMealRequest;
use App\Models\Meal;
use App\Repositories\MealsRepository;
use App\Services\MealsService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Collection;

class MealsController extends Controller
{
    private MealsRepository $repository;
    private MealsService $service;

    public function __construct()
    {
        $this->repository = new MealsRepository();
        $this->service = new MealsService($this->repository);
    }

    public function list(): Collection
    {
        return $this->repository->getAll();
    }

    public function showById(int $id): Meal
    {
        $meal = $this->repository->getMealById($id);
        if ($meal) {
            return $meal;
        }

        abort(404, "Блюдо \"$id\" не найдено");
    }

    public function showBySlug(string $slug): Meal
    {
        $meal = $this->repository->getMealBySlug($slug);
        if ($meal) {
            return $meal;
        }

        abort(404, "Блюдо \"$slug\" не найдено");
    }

    public function createOrUpdate(CreateOrUpdateMealRequest $request)
    {
        $meal = new Meal($request->validated());

        try {
            $meal = $this->service->updateOrCreate($meal);
        } catch (UniqueConstraintViolationException $e) {
            return response()->json(['message' => 'Блюдо "' . $meal->getAttribute('slug') . '" уже существует'],400);
        } catch (ModelNotSavedException $e) {
            return response()->json(['message' => 'Не удалось создать блюдо'],400);
        }

        return $meal;
    }
}
