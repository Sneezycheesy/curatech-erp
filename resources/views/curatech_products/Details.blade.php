<x-app-layout>
    <div class=" dark:text-white py-6 max-w-7xl mx-auto">
        <div class="w-1/2 mx-auto">
            <x-edit-button hx-get="{{route('curatech_product_update', $curatech_product->curatech_product_id)}}" class="w-full" type="button">Wijzigen</x-edit-button>
        </div>
        
        <div class="grid grid-cols-2 auto-rows-max dark:bg-gray-700 py-6 mt-3 text-center max-w-6xl w-1/2 mx-auto">
            <div class="col-span-2 grid grid-cols-2 px-3">
                <p class="text-2xl">Naam</p>
                <x-text-input disabled value="{{ $curatech_product->name }}" />
            </div>
            <div class="col-span-2 grid grid-cols-2 px-3">
                <p class="text-2xl">Beschrijving</p>
                <x-text-area-input disabled>{{ $curatech_product->description }}</x-text-area-input>
            </div>
        </div>
        <div class="grid w-full grid-cols-3 grid-flow-cols auto-grid-rows overflow-y-scroll mt-6 text-center">
            <!-- Display TABLE of linked COMPONENTS-->
            <div class="grid grid-cols-3 border-b-2 border-gray-700 col-span-3">
                <div>ID</div>
                <div>Description</div>
                <div>Position</div>
            </div>

            @foreach ( $components as $component )
                <div>{{$component->component_id}}</div>
                <div class="whitespace-nowrap overflow-x-hidden text-ellipsis">{{$component->description}}</div>
                <div>{{$component->pivot->curatech_product_component_position}}</div>
            @endforeach
        </div>
    </div>
</x-app-layout>