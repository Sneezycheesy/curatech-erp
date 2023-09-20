<div id="components_container" class="col-span-3 grid grid-cols-3 auto-rows-max max-h-[400px] overflow-y-scroll">
@for($i = 0; $i < count($components); $i++)
    <a href="{{route('components.details', $components[$i]->component_id)}}" class="col-span-3 grid grid-cols-3 auto-rows-max hover:bg-red-800 hover:text-white hover:cursor-pointer py-2 {{$i % 2 ? 'dark:bg-gray-700 bg-gray-300' : 'dark:bg-gray-500 bg-gray-400'}}">
        <div>
            {{$components[$i]->component_id}}
        </div>
        <div class="inline overflow-hidden text-ellipsis whitespace-nowrap">
            {{$components[$i]->description}}
        </div>
        <div>
            {{$components[$i]->stock}}
        </div>
    </a>
@endfor
</div>