<?php

namespace App\Http\Requests\LunarAPI\Setting\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $db_prefix = config('lunar.database.table_prefix');
        return [
            'code' => "required|exists:" . $db_prefix . "currencies"
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required' => 'The code is required',
            'code.exists' => 'This code does not exists on the database',
        ];
    }
}
