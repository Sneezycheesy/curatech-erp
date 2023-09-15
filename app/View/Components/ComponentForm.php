<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComponentForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $buttontext,
        public \App\Models\Component $component
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.component_form');
    }
}
