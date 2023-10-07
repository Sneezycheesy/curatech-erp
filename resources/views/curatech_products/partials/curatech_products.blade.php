<div id="curatech_products_container" class="grid grid-cols-1 md:grid-cols-2 md:gap-x-2 gap-y-2 max-w-7xl mx-auto mt-3">
    @foreach ( $curatech_products as $curatech_product )
    <x-details-container onclick="browseTo('/curatech_products/{{$curatech_product->curatech_product_id}}')">
        <p class="text-lg">{{$curatech_product->curatech_product_id}} | {{ $curatech_product->name }}</p>
        <p class="overflow-x-hidden text-ellipsis">{{$curatech_product->description}}</p>
    </x-details-container>
    @endforeach
</div>