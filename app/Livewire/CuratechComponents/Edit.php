<?php

namespace App\Livewire\CuratechComponents;

use Livewire\Component;
use App\Livewire\Forms\ComponentAddVendorForm;
use App\Models\Component as CuratechComponent;
use App\Models\Stockroom;
use App\Models\Vendor;

use Illuminate\Http\Request;

use Mauricius\Http\HtmxLaravel\HtmxResponseClientRedirect;
use Mauricius\Http\HtmxLaravel\HtmxRequest;

class Edit extends Component
{
    public ComponentAddVendorForm $form;

    public $comp;
    public $vendors;
    public $all_vendors;
    public $all_stockrooms;
    public $linked_shelves;

    public $vendor_to_delete;

    public function mount($id) {
        $this->comp = CuratechComponent::find($id);
        $this->vendors = $this->comp->vendors()->get();
        $this->all_stockrooms = Stockroom::all();
        $this->linked_shelves = $this->comp->shelves()->get();

        $this->updateVendorsList();
    }

    public function render()
    {
        $this->updateVendorsList();
        return view('livewire.curatech-components.edit', [
            'disabled' => false,
        ]);
    }

    public function addVendor() {
        $this->form->save($this->comp);
    }

    public function detachVendor($vendor_id) {
        $this->comp->vendors()->detach($vendor_id);
    }

    private function updateVendorsList() {
        $this->vendors = CuratechComponent::find($this->comp->component_id)->vendors()->get();

        $this->all_vendors = Vendor::all()
            ->whereNotIn('id', $this->comp->vendors()->pluck('vendors_components.vendor_id')->toArray());
    }
}
