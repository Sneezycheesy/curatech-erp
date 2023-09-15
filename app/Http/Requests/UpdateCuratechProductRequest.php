<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCuratechProductRequest extends FormRequest
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
            'curatech_product_id' => 'required|max:10|unique:curatech_products,curatech_product_id,'.$this->route('id').',curatech_product_id',
            'description' => 'required',
            'name' => 'required|max:255',
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
            'curatech_product_id.unique' => 'Deze productcode is al in gebruik',
            'curatech_product_id.required' => 'De productcode is een verplicht veld',
            'curatech_product_id.max' => 'De productcode mag maximaal 10 karakters lang zijn',
            'description.required' => 'De beschrijving is een verplicht veld',
            'name.required' => 'De naam is een verplicht veld',
            'name.max' => 'De naam mag maximaal 255 karakters lang zijn',
        ];
    }
}
