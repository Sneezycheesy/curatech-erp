@props(['swap' => isset($swap) ? $swap : 'innerHTML', 'route' => $route, 'target' => $target])
<!-- Views using this component should pass in:
    $route => The URL used for the get request
    $target => The element (id) which's content to replace
    $swap => "Which content to replace (innerHTML, outerHTML, etc => See HTMX documentation for valid hx-swap values)
-->
<div {{ $attributes->merge(['class' => "grid grid-cols-12 gap-x-2 mt-5 py-7 px-7 bg-cbg-300 dark:text-paragraph-dark dark:bg-cbg-700 w-3/4 mx-auto h-max rounded"]) }}>
    <div class="grid grid-cols-10 gap-x-2 col-span-10">
        <!-- Searchbar -->
        <x-text-input hx-get="{{$route}}" 
            hx-target="{{$target}}" 
            hx-swap="{{$swap}}" 
            hx-include="[name='search']"
            hx-trigger="keyup[keyCode==13]"
            type="text"
            name="search" 
            id="search_components" 
            placeholder="Zoekt en gij zult vinden" 
            class="col-span-9 align-center text-primary-800"
        />
        
        <!-- Search button -->
        <x-primary-button hx-get="{{$route}}" 
            hx-target="{{$target}}" 
            hx-swap="{{$swap}}" 
            hx-include="[name='search']" 
            class="w-full">
            <i class="fa-solid fa-magnifying-glass"></i>
        </x-primary-button>
    </div>
    <div class="col-span-2">
        {{ $slot }} 
    </div>
</div>