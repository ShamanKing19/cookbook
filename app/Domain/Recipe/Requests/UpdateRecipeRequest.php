<?php

namespace App\Domain\Recipe\Requests;

use App\Domain\Meal\Meal;
use App\Domain\Recipe\Recipe;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric', 'exists:' . Recipe::class],
            'meal_id' => ['integer', 'exists:' . Meal::class . ',id'],
            'description' => ['string', 'max:65535'],
            'cooking_time' => ['numeric', 'min:0'],
            'author_id' => ['numeric', 'exists:' . User::class . ',id'],
            'slug' => ['string', 'max:' . config('constants.max_slug_length')]
        ];
    }
}
