<div id="information-container">
    <x-paragraph>Product</x-paragraph>
    <x-paragraph>{{$curatech_product->name}}</x-paragraph>

    <x-paragraph>Gewenst aantal</x-paragraph>
    <x-paragraph>{{$desired_stock->amount_initial}}</x-paragraph>

    <x-paragraph>Gemaakt aantal</x-paragraph>
    <x-paragraph>{{$desired_stock->amount_made}}</x-paragraph>

    <x-paragraph>Te maken aantal</x-paragraph>
    <x-paragraph>{{$desired_stock->amount_to_make}}</x-paragraph>

    <x-paragraph>Startdatum</x-paragraph>
    <x-paragraph>{{$desired_stock->start_date}}</x-paragraph>

    <x-paragraph>Verloopdatum</x-paragraph>
    <x-paragraph>{{$desired_stock->expiration_date}}</x-paragraph>

    @if($desired_stock->expiration_date >= now())
    <x-edit-button class="absolute right-0 bottom-0 translate-y-full"
        hx-get="{{route('desired_stocks.edit', $desired_stock)}}"
        hx-target="#information-container"
    >
    </x-edit-button>
    @endif
</div>