<div id="curatech_products_container" class="grid grid-cols-1 gap-y-2 max-w-7xl mx-auto mt-3">
    @foreach ( $curatech_products as $curatech_product )
    <a href="/curatech_product/{{$curatech_product->curatech_product_id}}">
        <x-details-container>
            <p class="text-lg">{{$curatech_product->curatech_product_id}} | {{ $curatech_product->name }}</p>
            <p>{{$curatech_product->description}}</p>
        </x-details-container>
    </a>
    @endforeach
</div>