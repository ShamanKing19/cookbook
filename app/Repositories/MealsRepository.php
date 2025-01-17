<?php

namespace App\Repositories;

use App\Domain\Meal\Meal;
use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ModelNotUpdatedException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Collection;

class MealsRepository
{
    /**
     * Все блюда
     *
     * @return Collection<Meal>
     */
    public function getAll(): Collection
    {
        return Meal::all();
    }

    /**
     * Поиск блюда по id
     *
     * @param int $id
     *
     * @return Meal|null
     */
    public function getMealById(int $id): ?Meal
    {
        return Meal::find($id);
    }

    /**
     * Поиск блюда по коду
     *
     * @param string $slug
     *
     * @return Meal|null
     */
    public function getMealBySlug(string $slug): ?Meal
    {
        return Meal::where('slug', '=', $slug)->first();
    }

    /**
     * Сохранение блюда в базу данных
     *
     * @param Meal $meal
     *
     * @return Meal
     *
     * @throws UniqueConstraintViolationException
     * @throws ModelNotSavedException
     */
    public function save(Meal $meal): Meal
    {
        if ($id = $meal->getAttribute('id')) {
            $existingMeal = Meal::find($id);
            if ($existingMeal === null) {
                throw new ModelNotSavedException($meal, "Блюдо с id=$id не найден");
            }

            $result = $existingMeal->update($meal->toArray());
            if (!$result) {
                throw new ModelNotSavedException($meal, "Не удалось обновить блюдо с id=$id");
            }

            return $existingMeal->refresh();
        }

        if ($meal->save()) {
            return $meal->refresh();
        }

        throw new ModelNotSavedException($meal, "Не удалось создать блюдо");
    }
}