<x-app-layout>
    <div class="py-6">
    <div class="grid gap-2 grid-cols-10 grid-flow-cols grid-rows-1 mt-5 py-7 px-7 dark:text-white dark:bg-gray-700 w-3/4 mx-auto h-full rounded">
        <div class="grid col-1 col-span-8">
            <x-searchbar route="{{route('vendors')}}"
                target="#vendors_container"
                swap="outerHTML">    
            </x-searchbar>
        </div>
        
        <a href="{{route('curatech_products.create')}}"
            class="text-center bg-green-700 w-full h-full hover:bg-green-900 hover:cursor-pointer align-center col-span-2">
            <input type="button" value="Creëer" class="w-full h-full">
        </a>
        <!-- TODO: Add vendors.delete route -->
        <!-- <input type="button" value="Verwijder" class="disabled text-center bg-red-700 hover:bg-red-900 hover:cursor-default"> -->
    </div>

        @foreach ( $curatech_products as $curatech_product )
        <a href="/curatech_product/{{$curatech_product->curatech_product_id}}">
            <div class="mt-6 dark:bg-gray-700 dark:text-white text-black bg-white sm:rounded-lg px-6 max-w-6xl mx-auto py-4 hover:bg-gray-800 hover:text-white">
                <p class="text-lg"> {{ $curatech_product->name }}</p>
                <p>{{$curatech_product->description}}</p>
            </div>
        </a>
        @endforeach
    </div>
</x-app-layout>