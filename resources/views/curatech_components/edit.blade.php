<x-app-layout>
    <div x-data="{modal_open: false}">
        <div class="grid grid-cols-4 dark:text-white mt-9 py-5 px-5 dark:bg-cbg-700 h-max max-w-7xl mx-auto overflow-y-scroll rounded">
            <div class="col-span-2">
                @include('curatech_components.partials.edit-form')
            </div>

            <!-- Table to show, add and remove vendors from component-->
            <div class="col-span-2">
                @include('curatech_components.partials.vendors')
            </div>

        </div>
        
        <div class="flex justify-end max-w-7xl mx-auto mt-3 w-full">
            <x-primary-button type="submit" form="component_form" value="Opslaan">Opslaan</x-primary-button>
        </div>

        @if(session()->has('success'))
            <p class="mx-auto text-green-500 text-center text-2xl">{{session()->get('success')}}</p>
        @endif

        <div class="w-full max-w-7xl max-h-[50rem] mx-auto mt-5 p-2">
            <div class="flex justify-between w-full pr-3 align-middle">
                <x-title>Te vinden in</x-title>
                <x-new-button onclick="console.log('To be Implemented')" />
            </div>

            @foreach ($linked_shelves as $shelf)
                <x-details-container id="shelf_container_{{$shelf->id}}" class="mt-2" x-data="{delete_modal_open: false}">
                    <div class="flex justify-between">
                        <div class="grid grid-cols-1 auto-rows-max">
                            <p>Magazijn: {{$shelf->rack()->first()->stockroom()->first()->name}}</p>
                            <p>Stelling: {{$shelf->rack()->first()->name}}</p>
                            <p>Plank: {{$shelf->name}}</p>
                        </div>
                        <div class="h-max my-auto">
                            <x-delete-button @click="delete_modal_open = true" />
                        </div>
                    </div>

                    @include('curatech_components.partials.delete-shelf-confirm-modal')
                </x-details-container>
                
            @endforeach
        </div>


        <!-- #TODO: Implement SPLADE for modal views -->
        <x-new-modal title="Locatie toevoegen" :submit_post="route('components.shelf.add', $comp->component_id)" submit_include="[name='shelf_id']" target="#shelf_error">
            <x-text-input type="hidden" name="component_id" value="{{$comp->component_id}}" />
            <x-input-label for="stockroom_name">Magazijn</x-input-label>
            <x-select-box id="stockroom_name" name="stockroom_name">
                <x-slot name="options">
                    <option value="" selected>Selecteer een magazijn</option>
                    @foreach($all_stockrooms as $stockroom)
                    <option value="{{$stockroom->id}}">{{$stockroom->name}}</option>
                    @endforeach
                </x-slot>
            </x-select-box>
            <x-input-label for="rack_name">Stelling</x-input-label>
            <x-select-box id="rack_name" name="rack_name">
                <x-slot name="options">
                    @include('racks.partials.options')
                </x-slot>
            </x-select-box>
            <x-input-label for="shelf_name">Plank</x-input-label>
            <x-error-message id="shelf_error"></x-error-message>
            <x-select-box id="shelf_name" name="shelf_id">
                <x-slot name="options">
                    @include('shelves.partials.options')
                </x-slot>
            </x-select-box>
        </x-new-modal>
    </div>
</x-app-layout>