<x-app-layout>
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
        <x-primary-button class="ml-2" type="button" hx-get="{{route('components.details', $comp->component_id)}}" form="component_form" value="Opslaan">Annuleren</x-primary-button>
    </div>

    @if(session()->has('success'))
        <p class="mx-auto text-green-500 text-center text-2xl">{{session()->get('success')}}</p>
    @endif
</x-app-layout>