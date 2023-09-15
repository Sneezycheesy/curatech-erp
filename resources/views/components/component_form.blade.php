<form id="component_form" method='POST' class="text-center dark:text-white mt-9 py-5 px-5 dark:bg-gray-700 h-[600px] max-w-7xl mx-auto overflow-y-scroll rounded">
        @csrf
        <div class="grid grid-cols-2 gap-x-20 gap-y-8 auto-rows-max grid-flow-rows max-w-5xl mx-auto w-full h-min overflow-y-scroll">
            <div class="grid grid-cols-1 grid-rows-2 w-full text-center">
                <label for="component_id" class="w-full text-2xl">Artikelnummer</label>
                @error('component_id')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" value="{{$comp->component_id}}" name="component_id" id="component_id" placeholder="Artikelnummer" class="w-full text-center text-black">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="description" class="w-full text-2xl">Beschrijving</label>
                @error('description')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" value="{{$comp->description}}" name="description" id="description" placeholder="Beschrijving" class="w-full text-center text-black">
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
                <input type="text" name="unit_price" id="unit_price" placeholder="Prijs in €" class="w-full text-center text-black" value="{{$comp->unit_price}}">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="lt" class="w-full text-2xl">LT</label>
                @error('lt')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="number" name="lt" id="lt" placeholder="lt(?)" class="w-full text-center text-black" value="{{$comp->lt}}">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="c_number" class="w-full text-2xl">C-nummer</label>
                @error('c_number')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="number" name="c_number" id="c_number" placeholder="c-nummer" class="w-full text-center text-black" value="{{$comp->c_number}}">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="stock" class="w-full text-2xl">Voorraad</label>
                @error('stock')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="number" name="stock" id="stock" placeholder="Voorraad" class="w-full text-center text-black" value="{{$comp->stock}}">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="component_type" class="w-full text-2xl">Type</label>
                @error('component_type')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" name="component_type" id="component_type" placeholder="Type component" class="w-full text-center text-black" value="{{$comp->component_type}}">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="component_value" class="w-full text-2xl">Waarde</label>
                @error('component_value')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" name="component_value" id="component_value" placeholder="Waarde component" class="w-full text-center text-black" value="{{$comp->component_value}}">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="component_unit" class="w-full text-2xl">Eenheid</label>
                @error('component_unit')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" name="component_unit" id="component_unit" placeholder="Eenheid component" class="w-full text-center text-black" value="{{$comp->component_unit}}">
            </div>
        </div>
    </form>
    
    <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows max-w-7xl text-center mx-auto mt-5">
        <input type="submit" form="component_form" value="{{$buttontext}}" class="w-full text-center text-white rounded bg-gray-800 hover:bg-red-700 hover:cursor-pointer h-12">
    </div>