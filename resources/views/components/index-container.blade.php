<div id="index-container" {{$attributes->merge(['class' => "max-w-7xl mx-auto mt-3 py-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3"])}}>
    {{ $slot }}

    <i id="loading-indicator" class="htmx-indicator w-full fas fa-spinner fa-spin text-5xl text-center text-black dark:text-white col-span-full"></i>
</div>