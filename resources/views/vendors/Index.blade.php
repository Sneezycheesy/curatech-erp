<x-app-layout>
    <div class="grid gap-2 grid-cols-10 grid-flow-cols grid-rows-1 mt-5 py-7 px-7 dark:text-white dark:bg-gray-700 w-3/4 mx-auto h-full rounded">
            <input hx-get="{{route('vendors')}}" hx-target="#vendors_container" hx-swap="outerHTML" hx-include="[name='search']" hx-trigger="keyup[keyCode==13]" type="text" value="" name="search" id="search_components" placeholder="Zoekt en gij zult vinden" class="col-span-6 align-center dark:text-black" />
            <button hx-get="{{route('vendors')}}" hx-target="#vendors_container" hx-swap="outerHTML" hx-include="[name='search']" class="col-span-2 text-center bg-gray-400 dark:bg-gray-800 w-full hover:bg-red-700 hover:cursor-pointer">Go</button>
        
        <a href="{{route('vendors.create')}}" class="text-center bg-green-700 w-full h-full hover:bg-green-900 hover:cursor-pointer align-center">
            <input type="button" value="Creëer" class="w-full h-full">
        </a>
        <!-- TODO: Add vendors.delete route -->
        <!-- <input type="button" value="Verwijder" class="disabled text-center bg-red-700 hover:bg-red-900 hover:cursor-default"> -->
    </div>
    
    @include('vendors.partials.Vendors')
</x-app-layout>