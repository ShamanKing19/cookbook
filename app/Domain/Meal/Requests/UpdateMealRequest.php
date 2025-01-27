<?php

namespace App\Domain\Meal\Requests;

use App\Domain\Meal\Meal;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMealRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maxLength = config('constants.max_slug_length');

        return [
            'id' => ['required', 'exists:' . Meal::class],
            'name' => ['string', "max:$maxLength"],
            'slug' => ['string', "max:$maxLength", 'unique:' . Meal::class . ',slug']
        ];
    }
}
