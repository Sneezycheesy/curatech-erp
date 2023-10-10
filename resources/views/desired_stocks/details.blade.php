<x-app-layout>
    <x-slot name="header">
        Gewenste voorraad {{$curatech_product->name}}
    </x-slot>

    <div class="w-full p-8 grid grid-cols-1 md:grid-cols-2 gap-x-5">
        <div id="details-container" class="relative h-max">
            <x-title>Informatie</x-title>
            @include('desired_stocks.partials.information-container')
        </div>
        <div>
            <x-title>Componenten</x-title>
            <x-table>
                <x-slot name="header">
                    <x-paragraph class="text-left">Artikelnummer</x-paragraph>
                    <x-paragraph class="text-left">Beschrijving</x-paragraph>
                </x-slot>

                <div class="max-h-[5rem]">
                    <x-slot name="tbody" class="max-h-[15rem]">
                    @foreach ($curatech_components as $curatech_component)
                        <x-table-row>
                            <x-paragraph class="text-left">{{$curatech_component->component_id}}</x-paragraph>
                            <x-paragraph class="overflow-hidden text-ellipsis whitespace-nowrap text-left">{{$curatech_component->description}}</x-paragraph>
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
        </div>
    </div>
</x-app-layout>