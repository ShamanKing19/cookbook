<?php

namespace App\Domain\Meal\Requests;

use App\Domain\Meal\Meal;
use Illuminate\Foundation\Http\FormRequest;

class CreateMealRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maxLength = config('constants.max_slug_length');

        return [
            'name' => ['required', 'string', "max:$maxLength"],
            'slug' => ['required', 'string', "max:$maxLength", 'unique:' . Meal::class . ',slug']
        ];
    }
}
