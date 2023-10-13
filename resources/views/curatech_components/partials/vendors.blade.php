
<div class="">
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
    <x-table>
    <x-slot name="header">
        <x-paragraph>Naam</x-paragraph>
        <x-paragraph>Productnummer</x-paragraph>
        <x-paragraph>stukprijs</x-paragraph>
        <x-paragraph>Opmerking</x-paragraph>

        @if (!$disabled)
        <x-paragraph><i class="fa-solid fa-gear"></i></x-paragraph>
        @endif
    </x-slot>

    <x-slot name="tbody">
    @php
        $counter = false;
    @endphp
        @foreach ( $vendors as $vendor )
        <x-table-row counter="{{$counter = !$counter}}">
            <x-paragraph>{{$vendor->name}}</x-paragraph>
            <x-paragraph>{{$vendor->pivot->vendor_product_nr}}</x-paragraph>
            <x-paragraph>€{{$vendor->pivot->component_unit_price}}</x-paragraph>
            <x-paragraph class="whitespace-nowrap overflow-hidden text-ellipsis hover:whitespace-normal">{{$vendor->pivot->remark}}</x-paragraph>

            @if(!$disabled)
                <x-paragraph @click="confirm_delete_modal_open = true"><i class="fa-solid fa-trash hover:cursor-pointer hover:text-red-400"></i></x-paragraph>
            @endif

            @include('curatech_components.partials.vendor-delete-confirm')
        </x-table-row>
        @endforeach
    </x-slot>
    </x-table>

    @foreach ( $vendors as $vendor )
    <div id="vendor_listitem_{{$vendor->id}}" class="grid col-span-7 {{$disabled ? 'grid-cols-4' : 'grid-cols-5'}} hover:bg-red-700rounded overflow-y-scroll"
        x-data="{confirm_delete_modal_open: false}">
        
    </div>
    @endforeach
</div>