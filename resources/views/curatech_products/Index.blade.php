<x-app-layout>
    <div class="py-6">
        @foreach ( $curatech_products as $curatech_product )
        <a href="/curatech_product/{{$curatech_product->curatech_product_id}}">
            <div class="mt-6 dark:bg-gray-700 dark:text-white text-black bg-white sm:rounded-lg px-6 max-w-7xl mx-auto py-4 hover:bg-gray-800 hover:text-white">
                <p class="text-lg"> {{ $curatech_product->name }}</p>
                <p>{{$curatech_product->description}}</p>
            </div>
        </a>
        @endforeach
    </div>
</x-app-layout>