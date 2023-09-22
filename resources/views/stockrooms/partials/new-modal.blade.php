<form class="grid grid-cols-1 rounded auto-rows-max absolute w-1/4 h-min dark:bg-gray-800 bg-gray-200 py-4 px-3 gap-y-3 place-self-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
    <p class="text-2xl dark:text-white">Nieuwe stelling</p>
    @csrf
    <x-input-label>Naam</x-input-label>
    <x-error-message id="name_error"></x-error-message>
    <x-text-input name="name" placeholder="'merica" />
    <div class="flex justify-end">
        <x-primary-button class="mr-2" hx-post="{{route('racks.store', $id)}}" hx-include="[name='name']" hx-target="#name_error">OK</x-primary-button>
        <x-primary-button>X</x-primary-button>
    </div>
</form>