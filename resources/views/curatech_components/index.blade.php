<x-app-layout>
    <!-- Toolbar for searching and other actions -->
    <x-slot name="header">
        {{ __('Componenten') }}
    </x-slot>
    <x-searchbar
        route="{{route('components')}}"
        target="#components_container"
        swap="outerHTML"
    >
        <x-new-button type="button"
            onclick="browseTo(&quot;{{route('components.create')}}&quot;)"
            value="Creëer" 
            class="col-span-2 w-full h-full hover:cursor-pointer" />
    </x-searchbar>

    <!-- Components overview -->
    <div class="grid grid-cols-3 grid-flow-cols text-paragraph-light dark:text-paragraph-dark pt-7 max-w-7xl mx-auto text-center gap-y-2">
        <div class="grid col-span-5 grid-cols-3 grid-flows-cols text-center text-title-light dark:text-title-dark pb-2 border-b-2 border-cbg-700 overlow-y-scroll">
            <div>
                ID
            </div>
            <div>
                Beschrijving
            </div>
            <div>
                Voorraad
            </div>
        </div>
        @include('curatech_components.partials.components')
    </div>
</x-app-layout>