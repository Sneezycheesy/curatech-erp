<?php

namespace App\Livewire\CuratechComponents;

use Livewire\Component;
use App\Models\Component as CuratechComponent;
use App\Models\Stockroom;
use App\Models\Vendor;

use Mauricius\Http\HtmxLaravel\HtmxResponseClientRedirect;
use Mauricius\Http\HtmxLaravel\HtmxRequest;

class Edit extends Component
{
    public $comp;
    public $vendors;
    public $all_vendors;
    public $all_stockrooms;
    public $linked_shelves;

    public function mount($id) {
        $this->comp = CuratechComponent::find($id);
        $this->vendors = $this->comp->vendors()->get();
        $this->all_vendors = Vendor::all()
            ->whereNotIn('id', $this->comp->vendors()->pluck('vendors_components.vendor_id')->toArray());
        $this->all_stockrooms = Stockroom::all();
        $this->linked_shelves = $this->comp->shelves()->get();
    }

    public function render()
    {
        return view('livewire.curatech-components.edit', [
            'disabled' => false,
        ]);
    }
}
