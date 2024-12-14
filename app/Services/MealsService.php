<?php

namespace App\Services;

use App\Exceptions\ModelNotSavedException;
use App\Models\Meal;
use App\Repositories\MealsRepository;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Str;

class MealsService
{
    private MealsRepository $repository;

    public function __construct(MealsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Создание или обновление блюда
     *
     * @param Meal $meal
     *
     * @return Meal
     *
     * @throws UniqueConstraintViolationException
     * @throws ModelNotSavedException
     */
    public function updateOrCreate(Meal $meal): Meal
    {
        if (empty($meal->getAttribute('slug'))) {
            $meal->setAttribute('slug', Str::slug($meal->getAttribute('name')));
        }

        if ($this->repository->save($meal)) {
            return $meal;
        }

        throw new \RuntimeException('Не удалось создать блюдо "' . $meal->getAttribute('slug') . '"');
    }
}