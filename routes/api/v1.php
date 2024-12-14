<?php

use App\Http\Controllers\MealsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::get('/meals', [MealsController::class, 'list']);
    Route::get('/meals/{id}', [MealsController::class, 'showById'])->whereNumber('id');
    Route::get('/meals/{slug}', [MealsController::class, 'showBySlug'])->whereAlpha('slug');
    Route::post('/meals', [MealsController::class, 'createOrUpdate']);
});
