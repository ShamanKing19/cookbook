<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateMealRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer'],
            'name' => ['string', 'max:255'],
            'slug' => ['string', 'max:255'],
        ];
    }
}
