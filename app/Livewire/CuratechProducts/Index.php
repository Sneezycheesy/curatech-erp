<?php

namespace App\Livewire\CuratechProducts;

use Livewire\Component;
use App\Models\CuratechProduct;

class Index extends Component
{
    public $search;
    public $curatech_products;

    public function mount() {
        $this->curatech_products = CuratechProduct::all();
    }

    public function render()
    {
        return view('livewire.curatech-products.index');
    }

    public function filter() {
        $this->curatech_products = CuratechProduct::when($this->search, function ($query, $search) {
            $query->where('curatech_product_id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })->get();
    }
}
