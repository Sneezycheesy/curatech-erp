<x-app-layout>
<x-slot name="header">
    Inkoop
</x-slot>
    <x-index-container-horizontal id="desired-stocks-container">
        @foreach($desired_stocks as $desired_stock)
        <a href="{{route('desired_stocks.details', $desired_stock)}}" hx-boosted="true" class="min-w-[20rem]">
            <x-details-container>
                <x-details-container-title>
                    {{$desired_stock->curatechProduct->name}}
                </x-details-container-title>
                <x-paragraph>Totaal aantal: {{$desired_stock->amount_initial}}</x-paragraph>
                <x-paragraph>Gemaakt aantal: {{$desired_stock->amount_made}}</x-paragraph>
                <x-paragraph>Te maken aantal: {{$desired_stock->amount_to_make}}</x-paragraph>
            </x-details-container>
        </a>
        @endforeach

        @if($desired_stocks->nextPageUrl())
        <div 
            hx-get="{{$desired_stocks->nextPageUrl()}}"
            hx-select="#index-container-horizontal>a"
            hx-swap="outerHTML"
            hx-trigger="intersect"
            hx-indicator="#container-horizontal-loading-indicator"
        >
        </div>
        @endif
    </x-index-container-horizontal>

    <x-title class="w-full">Overzicht</x-title>
    <x-table class="col-span-full">
        <x-slot name="header">
            <x-paragraph>Artikelnummer</x-paragraph>
            <x-paragraph class="hidden md:block">Magazijn</x-paragraph>
            <x-paragraph class="hidden md:block">Machines</x-paragraph>
            <x-paragraph class="hidden md:block">Voorraad</x-paragraph>
            <x-paragraph class="hidden lg:block">Leveranciers</x-paragraph>
            <x-paragraph class="hidden lg:block">Stukprijs</x-paragraph>
            <x-paragraph>Nodig</x-paragraph>
            <x-paragraph>Tekort</x-paragraph>
            <x-paragraph class="hidden lg:block">
                Totaal
                @if ($total_price > 0)
                <br/>
                €{{$total_price}}
                @endif
            </x-paragraph>
        </x-slot>

        <div class="max-h-[20rem]">
        <x-slot name="tbody">
            {{ $i = false }}
            @foreach($curatech_components as $curatech_component)
            <x-table-row :counter="$i = !$i">
                <x-paragraph>
                    <a href="{{route('components.details', $curatech_component->component_id)}}" class="hover:text-primary">
                        {{$curatech_component->component_id}}
                    </a>
                </x-pragraph>
                <x-paragraph class="hidden md:block">{{$curatech_component->stock}}</x-pragraph>
                <x-paragraph class="hidden md:block">{{$curatech_component->stock_machines}}</x-pragraph>
                <x-paragraph class="hidden md:block">{{$curatech_component->stock + $curatech_component->stock_machines}}</x-pragraph>
                <x-paragraph class="hidden lg:block">
                    @if ($curatech_component->vendors()->first())
                    {{$curatech_component->vendors()->first()->name}}
                    @endif
                </x-pragraph>
                <x-paragraph class="hidden lg:block">
                    @if ($curatech_component->vendors()->first())
                    €{{$curatech_component->vendors()->first()->pivot->component_unit_price}}
                    @endif
                </x-pragraph>
                <x-paragraph>{{$curatech_component->requiredStock()}}</x-pragraph>
                <x-paragraph>{{$curatech_component->stockShortage()}}</x-pragraph>
                <x-paragraph class="hidden lg:block">€{{$curatech_component->priceRequiredStock()}}</x-pragraph>
            </x-table-row>
            @endforeach

            @if($curatech_components->nextPageUrl())
            <div 
                hx-get="{{$curatech_components->nextPageUrl()}}"
                hx-select="#table-body-container>div"
                hx-swap="outerHTML"
                hx-trigger="intersect"
                hx-indicator="#loading-indicator"
            >
            </div>
            @endif
        </x-slot>
        </div>

    </x-table>
</x-app-layout>