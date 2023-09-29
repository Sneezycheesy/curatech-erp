<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Component as CuratechComponent;

class Components extends Component
{
    public $components;
    public $search;

    public function mount() {
        $this->components = CuratechComponent::all();
    }

    public function render()
    {
        return view('livewire.components', [
        ]);
    }

    public function filter() {
        $this->components = CuratechComponent::when($this->search, function($query, $search) {
            $query->where('component_id', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })->get();
    }
}
