<x-app-layout>
    <form id="component_form" method='POST' class="mt-4 text-center dark:text-white py-5 px-5 dark:bg-gray-700 h-[500px] max-w-7xl mx-auto overflow-y-scroll rounded">
        @csrf
        <div class="grid grid-cols-2 gap-x-20 gap-y-8 auto-rows-max grid-flow-rows max-w-5xl mx-auto w-full h-min overflow-y-scroll">
            <div class="col-span-2 text-3xl">
                Component details
            </div>
            <div class="grid grid-cols-1 grid-rows-2 w-full text-center">
                <label for="component_id" class="w-full text-2xl">Artikelnummer</label>
                @error('component_id')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" value="{{old('component_id')}}" name="component_id" id="component_id" placeholder="Artikelnummer" class="w-full text-center text-black">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="description" class="w-full text-2xl">Beschrijving</label>
                @error('description')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" value="{{old('description')}}" name="description" id="description" placeholder="Beschrijving" class="w-full text-center text-black">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="courant" class="w-full text-2xl">Courant</label>
                @error('courant')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <select name="courant" id="courant" class="text-black text-center">
                    <option value="Y" @if(old('courant') == 'Y') selected @endif>Ja</option>
                    <option value="N" @if(old('courant') == 'N') selected @endif>Nee</option>
                </select>
            </div>            
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="unit_price" class="w-full text-2xl">Stukprijs</label>
                @error('unit_price')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="text" name="unit_price" id="unit_price" placeholder="Prijs in €" class="w-full text-center text-black">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="lt" class="w-full text-2xl">LT</label>
                @error('lt')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="number" name="lt" id="lt" placeholder="lt(?)" class="w-full text-center text-black">
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <label for="stock" class="w-full text-2xl">Voorraad</label>
                @error('stock')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <input type="number" name="stock" id="stock" placeholder="Voorraad" class="w-full text-center text-black">
            </div>
        </div>
    </form>
    
    <div class="grid grid-cols-1 grid-rows grid-flow-rows max-w-7xl text-center mx-auto mt-5">
        <input type="submit" form="component_form" value="Aanmaken" class="w-full text-center text-white rounded bg-gray-800 hover:bg-red-700 hover:cursor-pointer h-12">
    </div>

    <!-- Upload csv files to import components -->
    <form class="grid grid-cols-1 auto-rows-max max-w-7xl mt-5 mx-auto text-center dark:bg-gray-700 dark:text-white py-4 rounded" action="{{route('components_upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        @error('file')
            <p class="w-full mx-auto text-red-700">{{$message}}</p>
        @enderror
        <input type="file" name="file" class="text-center" accept="text/csv"/>
        <input type="submit" value="Upload" class="dark:bg-gray-800 p-2 mt-2 w-1/2 mx-auto rounded-xl hover:bg-red-700 hover:cursor-pointer"/>
    </form>
</x-app-layout>