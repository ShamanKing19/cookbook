<?php

use App\Http\Controllers\MealsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('/meals')->group(function () {
//        Route::get('/', [MealsController::class, 'list']);
//        Route::get('/{id}', [MealsController::class, 'showById'])->whereNumber('id');
//        Route::get('/{slug}', [MealsController::class, 'showBySlug'])->where('slug', '[\w-]+');

        Route::post('/create', [MealsController::class, 'create'])->name('api.meals.create');
        Route::match(['patch', 'post'], '/update', [MealsController::class, 'update'])->name('api.meals.update');
        Route::match(['delete', 'post'], '/{id}/delete', [MealsController::class, 'delete'])->whereNumber('id')->name('api.meals.delete');

//        Route::get('/{id}/recipes', [MealsController::class, 'recipesById'])->whereNumber('id');
//        Route::get('/{slug}/recipes', [MealsController::class, 'recipesBySlug'])->where('slug', '[\w-]+');
    });
});
