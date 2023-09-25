<x-app-layout>
    <!-- Toolbar for searching and other actions -->
    <x-searchbar
        route="{{route('components')}}"
        target="#components_container"
        swap="outerHTML"
    >
        <x-new-button type="button"
            hx-get="{{route('components_create')}}"
            value="Creëer" 
            class="col-span-2 w-full h-full hover:bg-green-900 hover:cursor-pointer" />
    </x-searchbar>

    <!-- Components overview -->
    <div class="grid grid-cols-3 grid-flow-cols text-paragraph-light dark:text-paragraph-dark pt-7 px-7 w-3/4 mx-auto text-center gap-y-2">
        <div class="grid col-span-5 grid-cols-3 grid-flows-cols text-center text-title-light dark:text-title-dark pb-2 border-b-2 border-cbg-700 overlow-y-scroll">
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