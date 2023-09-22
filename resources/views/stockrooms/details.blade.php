<x-app-layout>
    <div class="grid grid-cols-1 w-full max-w-7xl mx-auto mt-6 p-5 dark:text-white">
        <div class="grid grid-cols-10 gap-x-2">
            <x-searchbar class="col-span-9"  :route="route('stockrooms.details', $id)" target="#racks_container"  />
            <x-new-button hx-get="{{route('stockrooms.racks.new', $id)}}" hx-target="#delete-modal" />
        </div>

        <!-- TODO add foreach stockrooms -->
        <x-input-label>Naam</x-input-label>
        <p>Magazijnnaam</p>

        <x-input-label>Locatie</x-input-label>
        <p>Magazijnlocatie</p>

        <div id="racks_container" class="grid grid-cols-5 auto-rows-max gap-3 mt-6">
            @include('stockrooms.partials.racks')
        </div>
    </div>

    <div id="delete-modal"></div>
</x-app-layout>