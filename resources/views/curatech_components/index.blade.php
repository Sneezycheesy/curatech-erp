<x-app-layout>
    <!-- Toolbar for searching and other actions -->
    <div class="grid gap-2 grid-cols-10 grid-flow-cols grid-rows-1 mt-5 py-7 px-7 dark:text-white dark:bg-gray-700 w-3/4 mx-auto h-full rounded">
        <div class="grid grid-cols-1 col-span-8">
            <x-searchbar
                route="{{route('components')}}"
                target="#components_container"
                swap="outerHTML"
            >
            </x-searchbar>
        </div>

        <x-new-button type="button"
            hx-get="{{route('components_create')}}"
            value="Creëer" 
            class="col-span-2 w-full h-full hover:bg-green-900 hover:cursor-pointer">Nieuw
        </x-new-button>
    </div>

    <!-- Components overview -->
    <div class="grid grid-cols-3 grid-flow-cols dark:text-white pt-7 px-7 w-3/4 mx-auto text-center gap-y-2">
        <div class="grid col-span-5 grid-cols-3 grid-flows-cols text-center dark:text-white pb-2 border-b-2 border-gray-700 overlow-y-scroll">
            <div>
                ID
            </div>
            <div>
                Beschrijving
            </div>
            <div>
                Voorraad
            </div>
        </div>
        @include('curatech_components.partials.components')
    </div>
</x-app-layout>