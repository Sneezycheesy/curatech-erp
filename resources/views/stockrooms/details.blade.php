<x-app-layout>
    <div x-data="{modal_open: false, name: '', name_error: ''}">
        <div class="block w-full max-w-7xl mx-auto mt-6 py-2 dark:text-white">
            <div class="grid grid-cols-10 gap-x-2">
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
            
        </div>
        
        <div class="flex justify-between w-full max-w-7xl mx-auto mt-6">
            <x-title>Stellingen</x-title>
        </div>
        <x-searchbar class="w-full max-w-7xl" :route="route('stockrooms.details', $id)" target="#racks_container" > 
            <x-new-button class="w-full h-full" @click="modal_open = true" />
        </x-searchbar>
        <div id="racks_container" class="grid grid-cols-1 auto-rows-max gap-3 mt-6 overflow-y-scroll max-h-[20rem] max-w-7xl mx-auto">
            @include('stockrooms.partials.racks')
        </div>
    
        <!-- <x-primary-button @click="new_open = ! new_open" /> -->
        @include('stockrooms.partials.new-modal')
    </div>
</x-app-layout>