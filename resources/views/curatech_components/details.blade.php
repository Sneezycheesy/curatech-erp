<x-app-layout>
    <div class="grid grid-cols-2 w-full sm:max-w-sm md:max-w-7xl mx-auto dark:bg-gray-700 bg-gray-200 dark:text-white p-5 rounded mt-5">
        @include('curatech_components.partials.edit-form', ['disabled' => $disabled])
        <!-- Container for list of vendors-->
        @include('curatech_components.partials.vendors', ['disabled' => $disabled])
    </div>

    <div class="flex justify-end w-full max-w-7xl py-5 mx-auto">
        <x-primary-button class="mr-2" hx-get="{{route('components.restock', $comp->component_id)}}"><i class="fa-solid fa-wallet"></i></x-primary-button>
        <x-edit-button hx-get="{{route('components.edit', $comp->component_id)}}" class="w-max"></x-edit-button>
    </div>
</x-app-layout>