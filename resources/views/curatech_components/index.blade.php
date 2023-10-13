<x-app-layout>
    <!-- Toolbar for searching and other actions -->
    <x-slot name="header">
        {{ __('Componenten') }}
    </x-slot>
    <x-searchbar>
        <x-new-button type="button"
            onclick="browseTo(&quot;{{route('components.create')}}&quot;)"
            value="Creëer" 
            class="col-span-2 w-full h-full hover:cursor-pointer" />
    </x-searchbar>

    <!-- Components overview -->
    <x-table>
        <x-slot name="header">
            <x-paragraph>
                ID
            </x-paragraph>
            <x-paragraph>
                Beschrijving
            </x-paragraph>
            <x-paragraph>
                Voorraad
            </x-paragraph>
        </x-slot>
        @include('curatech_components.partials.components')
    </x-table>
</x-app-layout>