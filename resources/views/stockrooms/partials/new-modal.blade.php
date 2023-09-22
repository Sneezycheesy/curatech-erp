<div class="absolute top-0 opacity-25 bg-white w-full h-full"
    x-show="modal_open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" >
</div>
    <form action="" method="post" class="z-10 opacity-100 grid grid-cols-1 rounded auto-rows-max absolute w-1/4 h-min dark:bg-gray-800 bg-gray-200 py-4 px-3 gap-y-3 place-self-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
    x-show="modal_open"        
    @click.outside="modal_open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95">
    <p class="text-2xl dark:text-white">Nieuwe stelling</p>
    @csrf
        <x-input-label>Naam</x-input-label>
        <x-error-message id="name_error"></x-error-message>
        <x-text-input x-model="name" name="name" placeholder="'merica" />
        <div class="flex justify-end">
            <x-primary-button type="submit" class="mr-2" hx-post="{{route('racks.store', $id)}}" hx-include="[name='name']" hx-target="#name_error">OK</x-primary-button>
            <x-primary-button type="button" @click="modal_open = false" hx-get="{{route('stockrooms.racks.new.close')}}" hx-target="#name_error" >X</x-primary-button>
        </div>
    </form>