<x-app-layout>    
    <x-slot name="header">
            {{ __('Inkoop') }}
    </x-slot>
    <div class="max-w-7xl mx-auto mt-3 bg-cbg-200 text-black p-3 dark:bg-cbg-700 dark:text-white rounded" x-data="{open_writeoff_modal: false, curatech_product_id: null}">
    <!-- Display curatech device stock supplies -->
    <div class="text-center align-middle w-full">
        <form>
            @csrf
            @if (count($curatech_products) > 4)
            <div class="grid gap-y-4 auto-cols-max grid-flow-col-dense grid-rows-2 overflow-scroll h-full">
            @else
            <div class="grid gap-y-4 auto-cols-max grid-flow-col-dense overflow-scroll h-full">
            @endif
                @foreach ( $curatech_products as $curatech_product )
                <div class="grid gap-y-1 grid-cols-1 px-2">
                    <x-input-label class="" for="product-name">{{$curatech_product->curatech_product_id}} | {{$curatech_product->name}}</x-input-label>
                    <div class="relative">
                        <x-text-input class="text-center" name="{{$curatech_product->curatech_product_id}}" value="{{$curatech_product->stock_desired}}" />
                        <div class="absolute right-0 top-1/2 w-min -translate-y-1/2 pr-3">
                            <x-paragraph @click="open_writeoff_modal = true; curatech_product_id = '{{$curatech_product->curatech_product_id}}'" class="fa-solid fa-arrow-down hover:cursor-pointer hover:text-primary-600"></x-paragraph>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <x-primary-button hx-post="{{route('purchases_update_stock')}}" hx-target='#components_table' class="w-1/6 my-3">
                Update
            </x-primary-button>
        </form>
    </div>

    @include('purchases.partials.write-off-modal')

    <!-- Display all needed components and their required stock based on curatech product stock supplies -->
    <x-header-row>
        <!-- First row aka. header -->
            <x-paragraph>Artikelnr</x-paragraph>
            <x-paragraph>Beschrijving</x-paragraph>
            <x-paragraph>Leveranciers</x-paragraph>
            <x-paragraph>Productnummer</x-paragraph>
            <x-paragraph>
                Voorraad
                <br />
                {{$stock_value}}
            </x-paragraph>
            <x-paragraph>Nodig</x-paragraph>
            <x-paragraph>Tekort</x-paragraph>
            <x-paragraph>Stukprijs</x-paragraph>
            <x-paragraph>
                Totaalprijs
                <br/>
                €{{$total_price}}
            </x-paragraph>
            <x-paragraph>Acties</x-paragraph>
    </x-header-row>

        <!-- FOREACH component
            FOREACH curatech_device add column
                Display number of component required if device is linked to component
            Add column with component data for each column described above
        -->
        <div id="components_table">
            @include('purchases.partials.components-table')
        </div>
    </div>
</x-app-layout>