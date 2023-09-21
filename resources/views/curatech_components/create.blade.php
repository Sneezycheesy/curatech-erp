<x-app-layout>
    <form id="component_form" method='POST' class="mt-4 text-center dark:text-white py-5 px-5 dark:bg-gray-700 h-[500px] max-w-7xl mx-auto overflow-y-scroll rounded">
        @csrf
        <div class="grid grid-cols-2 gap-x-20 gap-y-8 auto-rows-max grid-flow-rows max-w-5xl mx-auto w-full h-min overflow-y-scroll">
            <div class="col-span-2 text-3xl">
                Component aanmaken
            </div>
            <div class="grid grid-cols-1 grid-rows-2 w-full text-center">
                <x-input-label for="component_id" class="w-full text-2xl">Artikelnummer</x-input-label>
                @error('component_id')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" name="component_id" id="component_id" placeholder="Artikelnummer" class="w-full text-center text-black">{{old('component_id')}}</x-text-input>
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <x-input-label for="description" class="w-full text-2xl">Beschrijving</x-input-label>
                @error('description')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" name="description" id="description" placeholder="Beschrijving" class="w-full text-center text-black">{{old('description')}}</x-text-input>
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <x-input-label for="courant" class="w-full text-2xl">Courant</x-input-label>
                @error('courant')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-select-box name="courant" id="courant" class="text-black text-center">
                    <x-slot name="options">
                        <option value="Y" @if(old('courant') == 'Y') selected @endif>Ja</option>
                        <option value="N" @if(old('courant') == 'N') selected @endif>Nee</option>
                    </x-slot>
                </x-select-box>
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <x-input-label for="lt" class="w-full text-2xl">LT</x-input-label>
                @error('lt')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" name="lt" id="lt" placeholder="lt(?)" class="w-full text-center text-black">{{old('ly')}}</x-text-input>
            </div>
            <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                <x-input-label for="stock" class="w-full text-2xl">Voorraad</x-input-label>
                @error('stock')
                    <div class="text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" name="stock" id="stock" placeholder="Voorraad" class="w-full text-center text-black">{{old('stock')}}</x-text-input>
            </div>
        </div>
    </form>
    
    <div class="grid grid-cols-1 grid-rows grid-flow-rows max-w-7xl text-center mx-auto mt-5">
        <x-primary-button type="submit" form="component_form" value="Aanmaken" class="w-1/2 mx-auto">Aanmaken</x-primary-button>
        @if(session('success'))
            <p class="text-green-400">{{session('success')}}</p>
        @endif
    </div>

    <!-- Upload csv files to import components -->
    <form class="grid grid-cols-1 auto-rows-max max-w-7xl mt-5 mx-auto text-center dark:bg-gray-700 dark:text-white py-4 rounded" action="{{route('components_upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        @error('file')
            <p class="w-full mx-auto text-red-700">{{$message}}</p>
        @enderror
        <input type="file" name="file" class="text-center" accept="text/csv"/>
        <x-primary-button type="submit" value="Upload" class="w-1/2 mt-3 mx-auto">Upload</x-primary-button>
    </form>
</x-app-layout>