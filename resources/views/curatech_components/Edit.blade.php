<x-app-layout>
    <div class="grid grid-cols-4 dark:text-white mt-9 py-5 px-5 dark:bg-gray-700 h-max max-w-7xl mx-auto overflow-y-scroll rounded">
        <form id="component_form" method='POST' class="col-span-2 text-center ">
            @csrf
            <div class="grid grid-cols-2 gap-x-10 gap-y-2 auto-rows-max grid-flow-rows max-w-5xl mx-auto w-full h-max overflow-y-scroll">
                <x-input-label for="component_id" class="w-full col-span-2">Artikelnummer</x-input-label>
                @error('component_id')
                    <div class="col-span-2 text-red-900 dark:text-red-500">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" value="{{$comp->component_id}}" name="component_id" id="component_id" placeholder="Artikelnummer" class="w-full text-center col-span-2" />
                <div class="grid grid-cols-1 grid-rows-2 grid-flow-rows w-full text-center">
                    <x-input-label for="courant" class="w-full text-2xl h-min">Courant</x-input-label>
                    @error('courant')
                        <div class="text-red-900 dark:text-red-500">
                            {{$message}}
                        </div>
                    @enderror
                    <x-select-box name="courant" id="courant" class="text-black text-center">
                        <x-slot name="options">
                            <option value="Y" @if($comp->courant) selected @endif>Ja</option>
                            <option value="N" @if(!$comp->courant) selected @endif>Nee</option>
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
                    <x-text-input type="text" name="lt" id="lt" placeholder="lt(?)" class="w-full text-center text-black" value="{{$comp->lt}}" />
                </div>           
                <div class="grid grid-cols-1 grid-rows-2 row-span-1 col-span-2 grid-flow-rows w-full text-center">
                    <x-input-label for="description" class="w-full text-2xl h-min">Beschrijving</x-input-label>
                    @error('description')
                        <div class="text-red-900 dark:text-red-500">
                            {{$message}}
                        </div>
                    @enderror
                    <x-text-input type="text" name="description" id="description" placeholder="Beschrijving" class="h-max w-full text-center text-black" value="{{$comp->description}}"></x-text-input>
                </div>
            </div>
        </form>

        <!-- Table to show, add and remove vendors from component-->
        @include('curatech_components.partials.vendors')

    </div>
    
    <div class="flex justify-end max-w-7xl mx-auto mt-3 w-full">
        <x-primary-button type="submit" form="component_form" value="Opslaan">Opslaan</x-primary-button>
        <x-primary-button class="ml-2" type="button" hx-get="{{route('components.details', $comp->component_id)}}" form="component_form" value="Opslaan">Annuleren</x-primary-button>
    </div>

    @if(session()->has('success'))
        <p class="mx-auto text-green-500 text-center text-2xl">{{session()->get('success')}}</p>
    @endif
</x-app-layout>