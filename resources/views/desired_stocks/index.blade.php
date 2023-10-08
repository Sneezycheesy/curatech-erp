<x-app-layout>
<x-slot name="header">
    Inkoop
</x-slot>
    <x-index-container-horizontal>
        @foreach($desired_stocks as $desired_stock)
        <x-details-container class="min-w-[20rem]">
            <x-details-container-title>
                {{$desired_stock->curatechProduct->name}}
            </x-details-container-title>
            <x-paragraph>Totaal aantal: {{$desired_stock->amount_initial}}</x-paragraph>
            <x-paragraph>Gemaakt aantal: {{$desired_stock->amount_made}}</x-paragraph>
            <x-paragraph>Te maken aantal: {{$desired_stock->amount_to_make}}</x-paragraph>
        </x-details-container>
        @endforeach
    </x-index-container-horizontal>

    <x-title class="w-full">Overzicht</x-title>
    <x-table>
        <x-slot name="header">
            <x-paragraph>Artikelnummer</x-paragraph>
            <x-paragraph class="hidden md:block">Magazijn</x-paragraph>
            <x-paragraph class="hidden md:block">Machines</x-paragraph>
            <x-paragraph class="hidden md:block">Voorraad</x-paragraph>
            <x-paragraph class="hidden lg:block">Leveranciers</x-paragraph>
            <x-paragraph class="hidden lg:block">Stukprijs</x-paragraph>
            <x-paragraph>Nodig</x-paragraph>
            <x-paragraph class="hidden lg:block">Totaal</x-paragraph>
        </x-slot>

        <x-slot name="tbody">
        @foreach($curatech_components as $curatech_component)
        <x-table-row>
            <x-paragraph>{{$curatech_component->component_id}}</x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
            <x-paragraph></x-pragraph>
        </x-table-row>
        @endforeach
        </x-slot>
    </x-table>
</x-app-layout>