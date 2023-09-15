<x-app-layout>
    <div class=" dark:text-white py-6 max-w-7xl mx-auto">
        <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
        <div class="grid grid-cols-3 auto-rows-max dark:bg-gray-700 py-6 text-center max-w-xl mx-auto">
            <div>
                <p>Naam</p> <p> {{ $curatech_product->name }}</p>
            </div>
            <div>
                <p>Beschrijving</p> <p> {{ $curatech_product->description }}</p>
            </div>
            <a href="{{route('curatech_product_update', $curatech_product->curatech_product_id)}}" class="p-5 w-full row-span-4 dark:bg-gray-800 w-min rounded hover:bg-red-700" type="button" value="Aanmaken">Wijzigen</a>
            <div><p>Voorraad</p><p>{{$curatech_product->stock}}</p></div>
            <div><p>Gewenste voorraad</p><p>{{$curatech_product->stock_desired}}</p></div>


        </div>
        <div class="grid w-full grid-cols-6 grid-flow-cols auto-grid-rows overflow-y-scroll mt-6 text-center">
            <!-- Display TABLE of linked COMPONENTS-->
            <div class="grid grid-cols-6 border-b-2 border-gray-700 col-span-6">
                <div>ID</div>
                <div>Description</div>
                <div>Position</div>
                <div>Value</div>
                <div>Type</div>
                <div>Unit</div>
            </div>

            @foreach ( $components as $component )
                <div>{{$component->component_id}}</div>
                <div class="whitespace-nowrap overflow-x-hidden text-ellipsis">{{$component->description}}</div>
                <div>{{$component->pivot->curatech_product_component_position}}</div>
                <div>{{$component->component_value}}</div>
                <div>{{$component->component_type}}</div>
                <div>{{$component->component_unit}}</div>
            @endforeach
        </div>
    </div>
</x-app-layout>