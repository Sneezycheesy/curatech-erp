<?php

namespace App\Livewire\Vendors;

use Livewire\Component;
use App\Models\Vendor;

class Index extends Component
{
    public $search;
    public $vendors;

    public function mount() {
        $this->vendors = Vendor::all();
    }

    public function render()
    {
        return view('livewire.vendors.index');
    }

    public function filter() {
        $this->vendors = Vendor::when($this->search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%")
                ->orWhere('zipcode', 'like', "%$search%")
                ->orWhere('city', 'like', "%$search%")
                ->orwhere('country', 'like', "%$search%");
        })->get();
    }
}
