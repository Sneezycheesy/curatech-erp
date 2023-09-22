@props([
    'title' => isset($title) ? $title : 'You forgot the title smartass',
    'submit_post' => isset($submit_post) ? $submit_post : '',
    'submit_include' => isset($submit_include) ? $submit_include : '[name="name"]',
    'target' => isset($target) ? $target : '',
])

<div class="absolute top-0 left-0 opacity-25 bg-gray-800 dark:bg-white w-full h-full"
    x-show="modal_open"
    x-transition:enter="transition linear duration-1000"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition linear duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
</div>

<form action="" method="post" class="opacity-100 grid grid-cols-1 rounded auto-rows-max absolute w-1/4 h-min dark:bg-gray-800 bg-gray-200 py-4 px-3 gap-y-3 place-self-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
x-show="modal_open"        
@click.outside="modal_open = false"
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 scale-95"
x-transition:enter-end="opacity-100 scale-100"
x-transition:leave="transition ease-in duration-150"
x-transition:leave-start="opacity-100 scale-100"
x-transition:leave-end="opacity-0 scale-95">
<p class="text-2xl dark:text-white">{{ $title }}</p>
@csrf
    {{ $slot }}
    <div class="flex justify-end">
        <x-primary-button type="submit" class="mr-2" hx-post="{{$submit_post}}" hx-include="{{$submit_include}}" hx-target="{{$target}}">OK</x-primary-button>
        <x-primary-button type="button" @click="modal_open = false" >X</x-primary-button>
    </div>
</form>