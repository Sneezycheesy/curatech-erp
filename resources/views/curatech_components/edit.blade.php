<x-app-layout>
    <div x-data="{modal_open: false}">
    <div class="grid grid-cols-4 dark:text-white mt-9 py-5 px-5 dark:bg-gray-700 h-max max-w-7xl mx-auto overflow-y-scroll rounded">
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
        <!-- <x-primary-button class="ml-2" type="button" hx-get="{{route('components.details', $comp->component_id)}}" form="component_form" value="Opslaan">Annuleren</x-primary-button> -->
        <x-back-button class="ml-2" :url="route('components.details', $comp->component_id)" />
    </div>

    @if(session()->has('success'))
        <p class="mx-auto text-green-500 text-center text-2xl">{{session()->get('success')}}</p>
    @endif

    <div class="w-full max-w-7xl max-h-[50rem] mx-auto mt-5 p-2">
        <div class="flex justify-between w-full">
            <x-title>Te vinden in</x-title>
            <x-new-button @click="modal_open = true" />
        </div>

        @foreach ($shelves as $shelf)
            <x-details-container class="mt-2">
                Magazijn: {{$shelf->rack()->first()->stockroom()->first()->name}} <br/>
                Stelling: {{$shelf->rack()->first()->name}}<br/>
                Plank: {{$shelf->name}}
            </x-details-container>
        @endforeach
    </div>

    <x-new-modal title="Locatie toevoegen" :submit_post="route('components.shelf.add', $comp->component_id)" submit_include="[name='shelf_id']" target="#shelf_error">
        <x-input-label for="stockroom_name">Magazijn</x-input-label>
        <select id="stockroom_name" name="stockroom_name">
            <option value="" selected>Selecteer een magazijn</option>
            @foreach($all_stockrooms as $stockroom)
            <option value="{{$stockroom->id}}" hx-get="{{route('racks.options', $stockroom->id)}}" hx-trigger="click"  hx-target="#rack_name">{{$stockroom->name}}</option>
            @endforeach
        </select>
        <x-input-label for="rack_name">Stelling</x-input-label>
        <select id="rack_name" name="rack_name">
            @include('racks.partials.options')
        </select>
        <x-input-label for="shelf_name">Plank</x-input-label>
        <x-error-message id="shelf_error"></x-error-message>
        <select id="shelf_name" name="shelf_id">
            @include('shelves.partials.options')
        </select>
    </x-new-modal>
    </div>
</x-app-layout>