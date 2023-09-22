<x-app-layout>
    <div x-data="{modal_open: false, name: '', name_error: ''}">
        <div class="block w-full max-w-7xl mx-auto mt-6 p-5 dark:text-white">
            <div class="grid grid-cols-10 gap-x-2">
                <x-searchbar class="col-span-9"  :route="route('stockrooms.details', $id)" target="#racks_container"  />
            </div>
            
            <div class="grid grid-cols-1 auto-rows-max w-full gap-y-3 mt-4">
                <div class="grid grid-cols-1 gap-y-1">
                    <x-title>Naam</x-title>
                    <p>{{$stockroom->name}}</p>
                </div>
                
                <div class="grid grid-cols-1 gap-y-1">
                    <x-title>Locatie</x-title>
                    <p>{{$stockroom->location}}</p>
                </div>
            </div>
            
            <div class="flex justify-between w-full mt-6">
                <x-title>Stellingen</x-title>
                <x-new-button class="w-max" @click="modal_open = true" />
            </div>
            <div id="racks_container" class="grid grid-cols-1 auto-rows-max gap-3 mt-6 overflow-y-scroll max-h-[20rem]">
                @include('stockrooms.partials.racks')
            </div>
        </div>
    
        <!-- <x-primary-button @click="new_open = ! new_open" /> -->
        @include('stockrooms.partials.new-modal')
    </div>
</x-app-layout>