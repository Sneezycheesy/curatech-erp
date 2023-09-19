<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComponentRequest extends FormRequest
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
            'component_id' => 'required|max:10|unique:components,component_id',
            'description' => 'required',
            'courant' => 'required',
            'unit_price' => 'required|numeric',
            'lt' => 'required|numeric',
            'stock' => 'required|numeric',
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
            'component_id.required' => 'Het artikelnummer is verplicht',
            'component_id.unique' => 'Dit artikelnummer is al in gebruik',
            'component_id.max' => 'Kan maximaal 10 karakters lang zijn',
            'description.required' => 'De beschrijving is verplicht',
            'courant.required' => 'Courant is verplicht',
            'unit_price.required' => 'De stukprijs is verplicht',
            'unit_price.numeric' => 'De stukprijs moet een geldig getal zijn',
            'lt.required' => 'Lt is verplicht',
            'lt.numeric' => 'Lt moet een geldig getal zijn',
            'stock.required' => 'De voorraad is verplicht',
            'stock.numeric' => 'De voorraad moet ene geldig getal zijn',
        ];
    }
}
