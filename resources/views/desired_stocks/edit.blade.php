<form method="post" action="" id="desired_stock_information_form">
    @csrf
    <x-input-label>Product</x-input-label>
    <x-paragraph>{{$curatech_product->name}}</x-paragraph>

    <x-input-label>Gewenst aantal</x-input-label>
    @if ($desired_stock->start_date <= now())
    <x-paragraph>{{$desired_stock->amount_initial}}</x-paragraph>
    @else
    <x-text-input value="{{$desired_stock->amount_initial}}" />
    @endif

    <x-input-label>Gemaakt aantal</x-input-label>
    <x-paragraph>{{$desired_stock->amount_made}}</x-paragraph>

    <x-input-label>Te maken aantal</x-input-label>
    <x-paragraph>{{$desired_stock->amount_to_make}}</x-paragraph>

    <x-input-label>Startdatum</x-input-label>
    @if($desired_stock->start_date <= now())
    <x-paragraph>{{$desired_stock->start_date}}</x-paragraph>
    @else
    <x-text-input id="desired_stock_start_date" type="date" value="{{$desired_stock->start_date}}" min="{{now()->addDays(1)->format('Y-m-d')}}"/>
    @endif

    <x-input-label>Verloopdatum</x-input-label>
    @if($desired_stock->expiration_date <= now())
    <x-paragraph>{{$desired_stock->expiration_date}}</x-paragraph>
    @else
    <x-text-input type="date" min="{{now()->addDays(1)->format('Y-m-d')}}" value="{{$desired_stock->expiration_date}}" />
    @endif

    <x-primary-button hx-post="{{route('desired_stocks.update', $desired_stock)}}"
        hx-target="#desired_stock_information_form"
        hx-select="#information-container"
        class="absolute right-0 bottom-0 translate-y-full"
    >
        Opslaan
    </x-primary-button>
</form>