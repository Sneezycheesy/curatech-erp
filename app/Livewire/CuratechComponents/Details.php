<?php

namespace App\Livewire\CuratechComponents;

use Livewire\Component;
use App\Models\Component as CuratechComponent;
use App\Models\Vendor;

class Details extends Component
{
    public $comp;
    public $vendors;
    public $all_vendors;
    public $linked_shelves;
    public $purchase_history;

    public function mount($id) {
        $this->comp = CuratechComponent::find($id);
        $this->vendors = $this->comp->vendors()->withPivot('component_unit_price')->get();
        $this->all_vendors = Vendor::all();
        $this->linked_shelves = $this->comp->shelves()->get();
        $this->purchase_history = array_merge(
            $this->comp->restocks()->get()->keyBy('created_at')->toArray(),
            $this->comp->writeoffs()->with('curatech_product')->get()->keyBy('created_at')->toArray(),
            $this->comp->ownWriteoffs()->get()->keyBy('created_at')->toArray()
        );
    }

    public function render()
    {
        return view('livewire.curatech-components.details', [
            'disabled' => true,
        ]);
    }
}
