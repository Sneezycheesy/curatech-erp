<div id="curatech_products_container" class="max-w-6xl mx-auto grid sm:grid-cols-1 px-3 md:px-0 md:grid-cols-3 gap-2 mt-3">
    @foreach ( $curatech_products as $curatech_product )
    <x-details-container class="relative" hx-get="{{route('curatech_products.details', $curatech_product->curatech_product_id)}}">
        <p class="text-lg">{{$curatech_product->curatech_product_id}} | {{ $curatech_product->name }}</p>
        <p class="whitespace-nowrap overflow-hidden text-ellipsis">{{$curatech_product->description}}</p>
    </x-details-container>
    @endforeach
</div>