<div id="components_container" class="col-span-3 grid grid-cols-3 auto-rows-max max-h-[400px] overflow-y-scroll">
@for($i = 0; $i < count($components); $i++)
    <a href="{{route('components.details', $components[$i]->component_id)}}" 
        class="col-span-3 grid grid-cols-3 auto-rows-max hover:bg-primary-600 text-paragraph-700 dark:text-paragraph-200 hover:text-paragraph-200 
        hover:dark:text-paragraph-100 hover:cursor-pointer py-2 
        {{$i % 2 ? 'dark:bg-cbg-700 bg-cbg-200' : 'dark:bg-cbg-600 bg-cbg-100'}}">
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