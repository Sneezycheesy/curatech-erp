<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnectVendorToComponentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'vendor_id' => 'required|min:0',
            'vendor_product_nr' => 'required|max:20',
            'component_unit_price' => 'required|numeric',
        ];
    }

    public function messages(): array {
        return [
            'vendor_id.required' => '*Vereist',
            'vendor_product_nr.required' => '*Vereist',
            'vendor_product_nr.max' => 'Max 20 karakters',
            'component_unit_price.required' => '*Vereist',
            'component_unit_price.numeric' => '*Numeriek',
        ];
    }
}
