<?php

declare(strict_types=1);

use App\Orchid\Screens\Meals\MealDetailScreen;
use App\Orchid\Screens\Meals\MealsListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Recipes\RecipeDetailScreen;
use App\Orchid\Screens\Recipes\RecipesListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::screen('/main', PlatformScreen::class)->name('platform.main');

/**
 * Блюда
 */
Route::prefix('meals')->group(function () {
    Route::screen('/', MealsListScreen::class)->name('meals.list');
    Route::screen('/create', MealDetailScreen::class)->name('meals.create');
    Route::screen('/{id}', MealDetailScreen::class)->whereNumber('id')->name('meals.detail');
});

/**
 * Рецепты
 */
Route::prefix('recipes')->group(function () {
    Route::screen('/', RecipesListScreen::class)->name('recipes.list');
    Route::screen('/create', RecipeDetailScreen::class)->name('recipes.create');
    Route::screen('/{id}', RecipeDetailScreen::class)->whereNumber('id')->name('recipes.detail');
});

Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

