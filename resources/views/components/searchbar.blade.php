<!-- Views using this component should pass in:
    $route => The URL used for the get request
    $target => The element (id) which's content to replace
    $swap => "Which content to replace (innerHTML, outerHTML, etc => See HTMX documentation for valid hx-swap values)
-->
<form {{ $attributes->merge(['class' => "grid grid-cols-12 gap-x-2 mt-5 py-7 px-7 bg-cbg-200 dark:text-paragraph-dark dark:bg-cbg-700 max-w-3/4 md:max-w-7xl mx-auto h-max rounded"]) }}>
    <div class="grid grid-cols-10 gap-x-2 col-span-10">
        <!-- Searchbar -->
            <x-text-input                 
                type="text"
                name="search"
                value="{{request()->search}}"
                id="search_components" 
                placeholder="Zoekt en gij zult vinden" 
                class="col-span-8 align-center text-primary-800"
            />            
        <!-- </form> -->
        <!-- Search button -->
        <x-primary-button 
            type="submit"
            class="w-full col-span-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </x-primary-button>
    </div>
    <div class="col-span-2">
        {{ $slot }} 
    </div>
</form>