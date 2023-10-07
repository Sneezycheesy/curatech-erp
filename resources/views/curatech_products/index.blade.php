<x-app-layout>
    <x-slot name="header">
        {{ __('Producten')}}
    </x-slot>
    <div class="py-6">        
        <x-searchbar>    
            <x-new-button type="button" onclick="window.location.href = '/curatech_products/create'"
                class="bg-green-700 hover:bg-green-900 hover:cursor-pointer w-full h-full" />
        </x-searchbar>

        @include('curatech_products.partials.curatech_products')
    </div>
</x-app-layout>