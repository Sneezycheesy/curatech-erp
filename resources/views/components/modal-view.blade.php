<div id="modal-view-container" class="fixed top-0 left-0 w-full h-full" x-show="open_{{$name}}_modal" x-cloak
    x-transition:enter="transition ease-in duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-out duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div id="modal-view-backdrop" class="absolute top-0 left-0 w-full h-full bg-black dark:bg-white opacity-30">
    </div>

    <div id="modal-view-popup" class="absolute bg-cbg-400 dark:bg-cbg-800 w-1/2 mx-auto h-1/2 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded"
        x-on:click.outside="open_{{$name}}_modal = false"
    >
    <x-title class="text-center w-full mb-5">{{ $title }}</x-title>
    <x-paragraph class="absolute right-5 top-2 hover:cursor-pointer hover:text-primary" x-on:click="open_{{$name}}_modal = false">x</x-paragraph>
    {{ $slot }}
    </div>
</div>