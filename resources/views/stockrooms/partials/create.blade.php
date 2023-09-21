<form id="create_stockroom_form" class="grid grid-cols-1 auto-rows-max text-center px-5 gap-y-2">
    @csrf
    <x-input-label>Naam</x-input-label>
        <x-error-message :message="$name_error ?? null" />
    <x-text-input placeholder="Billy" name="name" :value="$name ?? ''"/>

    <x-input-label>Locatie</x-input-label>
        <x-error-message :message="$location_error ?? null" />
    <x-text-input placeholder="Tussen de vloer en het dak" name="location" :value="$location ?? ''" />

    <div class="flex justify-end w-full mt-2">
        <x-back-button :url="route('stockrooms')"/>
        <x-primary-button :hx-post="route('stockrooms.store')" hx-target="#create_stockroom_form" hx-swap="outerHTML" class="{{isset($success) ? 'bg-green-200 dark:bg-green-500' : ''}}">Opslaan</x-primary-button>
    </div>
</form>