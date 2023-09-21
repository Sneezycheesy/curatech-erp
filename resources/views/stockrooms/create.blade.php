<x-app-layout>
    <div class="w-full max-w-xl bg-gray-200 dark:bg-gray-700 dark:text-white mx-auto py-5 mt-6 rounded-lg">
        <form class="grid grid-cols-1 auto-rows-max text-center px-5 gap-y-2">
            @csrf
            <x-input-label>Naam</x-input-label>
            <x-text-input placeholder="Bartje" name="name" />

            <x-input-label>Locatie</x-input-label>
            <x-text-input placeholder="Tussen de vloer en het dak" name="location" />

            <div class="flex justify-end w-full mt-2">
                <x-back-button :url="route('stockrooms')"/>
                <x-primary-button :hx-post="route('stockrooms.store')">Opslaan</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>