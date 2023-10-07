<x-app-layout>
    <x-searchbar>
        <x-new-button type="button" onclick="window.location.href = '/stockrooms/create'" class="w-full h-full"/>
    </x-searchbar>

    <x-index-container>
        @include('stockrooms.partials.index-stockrooms')
    </x-index-container>
</x-app-layout>