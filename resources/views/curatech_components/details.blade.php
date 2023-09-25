<x-app-layout>
    <div class="grid grid-cols-2 w-full sm:max-w-sm md:max-w-7xl mx-auto dark:bg-cbg-700 bg-cbg-200 dark:text-white p-5 rounded mt-5">
        @include('curatech_components.partials.edit-form', ['disabled' => $disabled])
        
        @include('curatech_components.partials.vendors', ['disabled' => $disabled])
    </div>

    <div class="flex justify-end w-full max-w-7xl py-5 mx-auto">
        <x-back-button :url="route('components')" />
        <x-primary-button class="mr-2" hx-get="{{route('components.restock', $comp->component_id)}}"><i class="fa-solid fa-wallet"></i></x-primary-button>
        <x-edit-button hx-get="{{route('components.edit', $comp->component_id)}}" class="w-max"></x-edit-button>
    </div>

    @if (count($linked_shelves))
    <div class="w-full max-w-7xl max-h-[50rem] mx-auto mt-5 p-2">
        <div class="flex justify-between w-full">
            <x-title>Te vinden in</x-title>
        </div>

        <div class="grid grid-cols-2 gap-3">
            @foreach ($linked_shelves as $shelf)
                <x-details-container class="mt-2 grid grid-cols-1">
                    <p>Magazijn: {{$shelf->rack()->first()->stockroom()->first()->name}}</p>
                    <p>Stelling: {{$shelf->rack()->first()->name}}</p>
                    <p>Plank: {{$shelf->name}}</p>
                </x-details-container>
            @endforeach
        </div>
    </div>
    @endif

    <!-- show purchase history? -->
</x-app-layout>