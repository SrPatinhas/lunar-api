<?php

namespace App\Http\Requests\LunarAPI\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            "item_id"           => ["required", "exists:" . $db_prefix . "products"],
            "item_variant_id"   => ["required", "exists:" . $db_prefix . "product_variants"],
            "quantity"          => ['required', 'numeric', 'min:1', 'max:' . $db_prefix . "product_variants,stock"]
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
