<?php

namespace App\Livewire\CuratechComponents;

use Livewire\Component;
use App\Models\Component as CuratechComponent;

class Index extends Component
{
    public $components;
    public $search;

    public function mount() {
        $this->components = CuratechComponent::all();
    }

    public function render()
    {
        return view('livewire.curatech-components.index', [
        ]);
    }

    public function filter() {
        $this->components = CuratechComponent::when($this->search, function($query, $search) {
            $query->where('component_id', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })->get();
    }
}
