<x-app-layout>
    <x-slot name="header">
        {{ __('Leveranciers') }}
    </x-slot>
    <x-searchbar>    
        <x-new-button type="button" onclick="window.location.href = '/vendors/create'" class="w-full h-full"/>
    </x-searchbar>
    
    @include('vendors.partials.Vendors')
</x-app-layout>