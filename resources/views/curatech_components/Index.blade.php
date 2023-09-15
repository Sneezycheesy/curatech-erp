<x-app-layout>
    <!-- Toolbar for searching and other actions -->
    <div class="grid gap-2 grid-cols-10 grid-flow-cols grid-rows-1 mt-5 py-7 px-7 dark:text-white dark:bg-gray-700 w-3/4 mx-auto h-full rounded">
        <form class="col-span-8 grid grid-cols-8 grid-row-1 gap-x-2" method="get">
            <input type="text" value="{{$search}}" name="search" id="search_components" placeholder="Zoekt en gij zult vinden" class="col-span-6 align-center dark:text-black" />
            <input type="submit" value="Go" class="col-span-2 text-center bg-gray-400 dark:bg-gray-800 w-full hover:bg-red-700 hover:cursor-pointer" />
        </form>
        <a href="{{route('components_create')}}" class="text-center bg-green-700 w-full h-full hover:bg-green-900 hover:cursor-pointer align-center">
            <input type="button" value="Creëer" class="w-full h-full">
        </a>
        <input type="button" value="Verwijder" class="disabled text-center bg-red-700 hover:bg-red-900 hover:cursor-default">
    </div>

    <!-- Components overview -->
    <div class="grid grid-cols-4 grid-flow-cols dark:text-white pt-7 px-7 w-3/4 mx-auto text-center gap-y-2">
        <div class="grid col-span-5 grid-cols-4 grid-flows-cols text-center dark:text-white pb-2 border-b-2 border-gray-700 overlow-y-scroll">
            <div>
                ID
            </div>
            <div>
                Beschrijving
            </div>
            <div>
                Voorraad
            </div>
            <div>
                Stukprijs
            </div>
        </div>
        @foreach ($components as $component)
        <a href="{{route('components_details', $component->component_id)}}" class="col-span-4 grid grid-cols-4 auto-rows-max hover:bg-red-800 hover:cursor-pointer py-2">
            <div>
                {{$component->component_id}}
            </div>
            <div class="inline overflow-hidden text-ellipsis whitespace-nowrap">
                {{$component->description}}
            </div>
            <div>
                {{$component->stock}}
            </div>
            <div>
                €{{$component->unit_price}}
            </div>
        </a>
        @endforeach
    </div>
</x-app-layout>