<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

use App\Models\Component;

class ComponentAddVendorForm extends Form
{
    //
    #[Rule('required')]
    public $vendor_id = '';

    #[Rule('required|max:20')]
    public $vendor_product_nr = '';

    #[Rule('required|numeric')]
    public $component_unit_price = '';

    public function save(Component $component) {
        $this->validate();

        $component->vendors()->attach($this->vendor_id, [
            'vendor_product_nr' => $this->vendor_product_nr,
            'component_unit_price' => $this->component_unit_price,
        ]);

        $this->reset();
    }

    public function messages() {
        return [
            'vendor_id.required' => '*Verplicht',
            'vendor_product_nr.required' => '*Verplicht',
            'vendor_product_nr.max' => '*Maximaal 20 karakters' ,
            'component_unit_price.required' => '*Verplicht',
            'component_unit_price.numeric' => '*Geen geldig getal',
        ];
    }
}
