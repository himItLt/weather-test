<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class ForecastSearchDbRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'city_name' => ['required', 'string', 'max:80', 'exists:forecasts,city_name'],
        ];
    }
}
