<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class ForecastStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'city_name' => ['required', 'string', 'max:80'],
            'timestamp_dt' => ['required'],
            'text_dt' => ['required'],
            'min_temp' => ['required'],
            'max_temp' => ['required'],
            'wind_speed' => ['required']
        ];
    }
}
