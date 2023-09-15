<x-app-layout>

<div class="grid grid-cols-4 dark:text-white mt-9 py-5 px-5 dark:bg-gray-700 h-[600px] max-w-7xl mx-auto overflow-y-scroll rounded">

    <form id="component_form" method='POST' class="col-span-2 text-center ">
        @csrf
        <div class="grid grid-cols-2 gap-x-10 gap-y-2 auto-rows-max grid-flow-rows max-w-5xl mx-auto w-full h-max overflow-y-scroll">
            <div class="grid grid-cols-1 grid-rows-2 w-full text-center h-max">
                <label for="component_id" class="w-full text-2xl">Artikelnummer</label>
                @error('component_id')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" value="{{$comp->component_id}}" name="component_id" id="component_id" placeholder="Artikelnummer" class="w-full text-center text-black" />
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="courant" class="w-full text-2xl">Courant</label>
                @error('courant')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <select name="courant" id="courant" class="text-black text-center">
                    <option value="Y" @if($comp->courant) selected @endif>Ja</option>
                    <option value="N" @if(!$comp->courant) selected @endif>Nee</option>
                </select>
            </div>            
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="unit_price" class="w-full text-2xl">Stukprijs</label>
                @error('unit_price')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input name="unit_price" id="unit_price" placeholder="Prijs in €" class="w-full text-center text-black" value="{{$comp->unit_price}}" />
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="lt" class="w-full text-2xl">LT</label>
                @error('lt')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="number" name="lt" id="lt" placeholder="lt(?)" class="w-full text-center text-black" value="{{$comp->lt}}" />
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="stock" class="w-full text-2xl">Voorraad</label>
                @error('stock')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="number" name="stock" id="stock" placeholder="Voorraad" class="w-full text-center text-black" value="{{$comp->stock}}" />
            </div>            
            <div class="grid grid-cols-1 grid-rows-2 row-span-1 grid-flow-rows w-full text-center">
                <label for="description" class="w-full text-2xl h-min">Beschrijving</label>
                @error('description')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" name="description" id="description" placeholder="Beschrijving" class="h-max w-full text-center text-black" value="{{$comp->description}}"></x-text-input>
            </div>
        </div>
    </form>
    <div class="col-span-2 grid w-full grid-cols-7 grid-flow-cols auto-grid-rows gap-y-2 gap-x-2 text-center max-w-7xl mx-auto h-max px-2">
        <div class="grid grid-cols-7 col-span-7 text-white">
            <div class="col-span-3 text-2xl">Leverancier</div>
            <div class="col-span-2 text-2xl">Productnummer</div>
            <div class="col-span-2 text-2xl">Stukprijs</div>
        </div>       
        <!-- Show a selectbox that allows the user to add EXISTING components to the product -->
        <form id="add_vendor_form" method="post" action="{{route('components.vendor.add', $comp->component_id)}}" class="grid grid-cols-7 gap-x-2 col-span-7 w-full h-max">
            @csrf
            <select name="vendor_id" id="component_add_id_selector" class="col-span-3 text-black">
                @foreach($all_vendors as $vendor)
                    <option value="{{$vendor->id}}" class="text-black">{{$vendor->name}}</option>
                @endforeach
            </select>
            <x-text-input class="col-span-2" type="text" name="vendor_product_nr" id="vendor_product_nr" />
            <x-text-input class="col-span-2" type="text" name="component_unit_price" id="component_unit_price" />
        </form>
        
        <x-secondary-button type="submit" form="add_vendor_form" class="col-span-7 bg-gray-800">Toevoegen</x-secondary-button>

        <!-- Display TABLE of linked COMPONENTS-->
        <div class="grid grid-cols-3 border-b-2 border-gray-700 col-span-7 mt-3">
            <div>Naam</div>
            <div>Productnummer</div>
            <div>stukprijs</div>
        </div>

        @foreach ( $vendors as $vendor )
        <div class="grid col-span-7 grid-cols-3 hover:bg-red-700rounded overflow-y-scroll">
            <div>{{$vendor->name}}</div>
            <div>{{$vendor->pivot->vendor_product_nr}}</div>
            <div>{{$vendor->pivot->component_unit_price}}</div>            
        </div>
        @endforeach
    </div>
    
</div>
    <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows max-w-7xl text-center mx-auto mt-5">
        <x-secondary-button type="submit" form="component_form" value="Opslaan">Opslaan</x-secondary-button>
    </div>

    @if(session()->has('success'))
        <p class="mx-auto text-green-500 text-center text-2xl">{{session()->get('success')}}</p>
    @endif
</x-app-layout>