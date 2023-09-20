<x-app-layout>
    <div class="grid gap-2 grid-cols-10 grid-flow-cols grid-rows-1 mt-5 py-7 px-7 dark:text-white dark:bg-gray-700 w-3/4 mx-auto h-full rounded">
        <div class="grid col-1 col-span-8">
            <x-searchbar route="{{route('vendors')}}"
                target="#vendors_container"
                swap="outerHTML">    
            </x-searchbar>
        </div>
        
        <x-new-button hx-get="{{route('vendors.create')}}" class="col-span-2"/>
        <!-- TODO: Add vendors.delete route -->
        <!-- <input type="button" value="Verwijder" class="disabled text-center bg-red-700 hover:bg-red-900 hover:cursor-default"> -->
    </div>
    
    @include('vendors.partials.Vendors')
</x-app-layout>