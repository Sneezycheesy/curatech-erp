<x-app-layout>
   <x-component-form buttontext="Opslaan" :component="$comp">
    </x-component-form>
    @if(session()->has('success'))
        <p class="mx-auto text-green-500 text-center text-2xl">{{session()->get('success')}}</p>
    @endif

    <div class="grid w-full grid-cols-7 grid-flow-cols auto-grid-rows overflow-y-scroll mt-6 gap-x-2 text-center max-w-7xl mx-auto">
            <!-- Show a selectbox that allows the user to add EXISTING components to the product -->
            <form method="post" action="{{route('components.vendor.add', $comp->component_id)}}" class="grid grid-cols-7 gap-x-2 col-span-7 w-full">
                @csrf
                <select name="vendor_id" id="component_add_id_selector" class="col-span-4 text-black">
                    @foreach($all_vendors as $vendor)
                        <option value="{{$vendor->id}}" class="text-black">{{$vendor->name}}</option>
                    @endforeach
                </select>
                <input type="text" name="vendor_product_nr" id="vendor_product_nr">
                <input type="submit" value="Add" class="dark:bg-gray-700">
            </form>

            <!-- Display TABLE of linked COMPONENTS-->
            <div class="grid grid-cols-7 border-b-2 border-gray-700 col-span-7 mt-3">
                <div>ID</div>
                <div>Description</div>
                <div>Position</div>
                <div>Value</div>
                <div>Type</div>
                <div>Unit</div>
                <div>Acties</div>
            </div>

            @foreach ( $vendors as $vendor )
            <div class="grid col-span-7 grid-cols-3 hover:bg-red-700">
                <div>{{$vendor->name}}</div>
                <div class="whitespace-nowrap overflow-x-hidden text-ellipsis">{{$vendor->address}}</div>
                <div>{{$vendor->vendor_unit_price}}</div>
                
            </div>
            @endforeach
        </div>
</x-app-layout>