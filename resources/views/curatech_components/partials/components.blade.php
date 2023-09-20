<div id="components_container" class="col-span-4 grid grid-cols-4 auto-rows-max py-2">
@foreach($components as $component)
    <a href="{{route('components.details', $component->component_id)}}" class="col-span-4 grid grid-cols-4 auto-rows-max hover:bg-red-800 hover:cursor-pointer py-2">
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