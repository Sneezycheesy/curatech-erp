<x-index-container>
    @foreach ( $curatech_products as $curatech_product )
    <x-details-container onclick="browseTo('/curatech_products/{{$curatech_product->curatech_product_id}}')">
        <x-details-container-title class="text-lg">{{$curatech_product->curatech_product_id}} | {{ $curatech_product->name }}</x-details-container-title>
        <x-paragraph class="overflow-x-hidden text-ellipsis">{{$curatech_product->description}}</x-paragraph>
    </x-details-container>
    @endforeach

    @if($curatech_products->nextPageUrl())
    <div 
        hx-get="{{$curatech_products->nextPageUrl()}}"
        hx-select="#index-container>div"
        hx-swap="outerHTML"
        hx-trigger="intersect"
        hx-indicator="#loading-indicator"
    >
    </div>
    @endif
</x-index-container>