
<div class="grid w-full grid-cols-7 grid-flow-cols auto-grid-rows gap-y-2 gap-x-2 text-center max-w-7xl mx-auto h-max px-2">
    @if (!$disabled)
    <div class="grid grid-cols-7 col-span-7 text-white">
        <div class="col-span-3 text-2xl grid auto-rows-max grid-cols-1">
            <x-input-label>Leverancier</x-input-label>
            @error('vendor_id')
                <p class="text-red-500 text-base">{{$message}}</p>
            @enderror
        </div>
        <div class="col-span-2 text-2xl grid auto-rows-max grid-cols-1">
            <x-input-label>Productnummer</x-input-label>
            @error('vendor_product_nr')
                <p class="text-red-500 text-base">{{$message}}</p>
            @enderror
        </div>
        <div class="col-span-2 text-2xl grid auto-rows-max grid-cols-1">
            <x-input-label>Stukprijs</x-input-label>
            @error('component_unit_price')
                <p class="text-red-500 text-base">{{$message}}</p>
            @enderror
        </div>
    </div>

    <!-- Show a selectbox that allows the user to add EXISTING components to the product -->
    <form id="add_vendor_form" method="post" action="{{route('components.vendor.add', $comp->component_id)}}" class="grid grid-cols-7 gap-x-2 col-span-7 w-full h-max">
        @csrf
        <x-select-box name="vendor_id" id="component_add_id_selector" class="col-span-3 text-black">
            <x-slot name="options">
                <option value="" selected>Kies een leverancier</option>
                @foreach($all_vendors as $vendor)
                    <option value="{{$vendor->id}}" @if($vendor->id == old('vendor_id')) selected @endif>{{$vendor->name}}</option>
                @endforeach
            </x-slot>
        </x-select-box>
        <x-text-input class="col-span-2" type="text" name="vendor_product_nr" id="vendor_product_nr" value="{{old('vendor_product_nr')}}" />
        <x-text-input class="col-span-2" type="text" name="component_unit_price" id="component_unit_price" value="{{old('component_unit_price')}}"/>
    </form>
    
    <x-primary-button type="submit" form="add_vendor_form" class="col-span-7">Toevoegen</x-primary-button>
    @endif

    <!-- Display TABLE of linked COMPONENTS-->
    <div class="grid {{$disabled ? 'grid-cols-3' : 'grid-cols-4 mt-3'}} border-b-2 border-cbg-600 col-span-7">
        <x-input-label>Naam</x-input-label>
        <x-input-label>Productnummer</x-input-label>
        <x-input-label>stukprijs</x-input-label>

        @if (!$disabled)
        <div><i class="fa-solid fa-gear"></i></div>
        @endif
    </div>

    @foreach ( $vendors as $vendor )
    <div id="vendor_listitem_{{$vendor->id}}" class="grid col-span-7 {{$disabled ? 'grid-cols-3' : 'grid-cols-4'}} hover:bg-red-700rounded overflow-y-scroll"
        x-data="{confirm_delete_modal_open: false}">
        <div>{{$vendor->name}}</div>
        <div>{{$vendor->pivot->vendor_product_nr}}</div>
        <div>€{{$vendor->pivot->component_unit_price}}</div>

        @if(!$disabled)
            <div @click="confirm_delete_modal_open = true"><i class="fa-solid fa-trash hover:cursor-pointer hover:text-red-400"></i></div>
        @endif

        @include('curatech_components.partials.vendor-delete-confirm')
    </div>
    @endforeach
</div>