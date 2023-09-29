<x-app-layout>
    <div class="py-6">        
        <x-searchbar>    
            <x-new-button hx-get="{{route('curatech_products.create')}}"
                class="bg-green-700 hover:bg-green-900 hover:cursor-pointer w-full h-full" />
        </x-searchbar>

        @include('curatech_products.partials.curatech_products')
    </div>
</x-app-layout>