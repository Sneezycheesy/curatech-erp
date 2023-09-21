<x-app-layout>
    <div class="w-full max-w-6xl mt-3 py-5 mx-auto dark:text-white">
        <div class="grid grid-cols-8 gap-x-2">
            <div class="col-span-7">
                <x-searchbar :route="route('stockrooms')" swap="innerHTML" target="#stockrooms_container"></x-searchbar>
            </div>
            <x-new-button :hx-get="route('stockrooms.create')"/>
        </div>

        <div id="stockrooms_container" class="grid grid-cols-1 auto-rows-max gap-2 px-3 py-5">
            @include('stockrooms.partials.index-stockrooms')
        </div>
    </div>
</x-app-layout>