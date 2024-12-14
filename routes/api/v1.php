<?php

use App\Http\Controllers\MealsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('/meals')->group(function () {
        Route::get('/', [MealsController::class, 'list']);
        Route::get('/{id}', [MealsController::class, 'showById'])->whereNumber('id');
        Route::get('/{slug}', [MealsController::class, 'showBySlug'])->where('slug', '[\w-]+');

        Route::post('/', [MealsController::class, 'createOrUpdate']);

        Route::get('/{id}/recipes', [MealsController::class, 'recipesById'])->whereNumber('id');
        Route::get('/{slug}/recipes', [MealsController::class, 'recipesBySlug'])->where('slug', '[\w-]+');
    });
});
