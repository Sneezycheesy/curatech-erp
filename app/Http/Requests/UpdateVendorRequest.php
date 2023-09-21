<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
            'name' => 'required|unique:vendors,name,'.$this->route('id').',id',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            //
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'De naam is verplicht',
            'name.unique' => 'Deze naam is al in gebruik',
            'address.required' => 'Het adres is verplicht',
            'zipcode.required' => 'De postcode is verplicht',
            'city.required' => 'De stad is verplicht',
        ];
    }
}
