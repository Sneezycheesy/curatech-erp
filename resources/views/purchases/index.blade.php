<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 bg-cbg-300 text-black p-3 dark:bg-cbg-700 dark:text-white rounded">

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
                            <x-input-label class="" for="product-name">Product: {{$curatech_product->name}}</x-input-label>
                            <x-text-input class="text-center" name="{{$curatech_product->curatech_product_id}}" value="{{$curatech_product->stock_desired}}" />
                        </div>
                        @endforeach
                    </div>
                    <x-primary-button hx-post="{{route('purchases_update_stock')}}" hx-target='#components_table' class="w-1/6 my-3">Update</x-primary-button>
                </form>
        </div>

    <!-- Display all needed components and their required stock based on curatech product stock supplies -->
        <div class="grid mt-5 gap-x-1 grid-flow-col grid-cols-8 h-max-h-400 mx-auto text-center">
            <!-- First row aka. header -->
                <div class="">
                    <x-paragraph>Artikelnr</x-paragraph>
                </div>
                <div class="">
                    <x-paragraph>Beschrijving</x-paragraph>
                </div>
                <div class="">
                    <x-paragraph>Voorraad</x-paragraph>
                </div>
                <div class="">
                    <x-paragraph>Nodig</x-paragraph>
                </div>
                <div class="">
                    <x-paragraph>Leveranciers</x-paragraph>
                </div>
                <div class="">
                    <x-paragraph>Productnummer</x-paragraph>
                </div>
                <div>
                    <x-paragraph>Stukprijs</x-paragraph>
                </div>
                <div>
                    <x-paragraph>Acties</x-paragraph>
                </div>
            </div>

            <!-- FOREACH component
                FOREACH curatech_device add column
                    Display number of component required if device is linked to component
                Add column with component data for each column described above
            -->
            <div id="components_table">
                @include('purchases.partials.components-table')
            </div>

            <!-- Display total price of components to be ordered -->
    </div>
</x-app-layout>