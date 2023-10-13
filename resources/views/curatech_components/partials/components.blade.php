<x-slot name="tbody">
@php
    $counter = false;
@endphp
@foreach($curatech_components as $curatech_component)
    <a href="{{route('components.details', $curatech_component->component_id)}}">
    <x-table-row counter="{{$counter = !$counter}}">
        <x-paragraph>
            {{$curatech_component->component_id}}
        </x-paragraph>
        <x-paragraph class="inline overflow-hidden text-ellipsis whitespace-nowrap">
            {{$curatech_component->description}}
        </x-paragraph>
        <x-paragraph>
            {{$curatech_component->stock}}
        </x-paragraph>
    </x-table-row>
    </a>
@endforeach
        @if($curatech_components->nextPageUrl())
        <a 
            hx-get="{{$curatech_components->nextPageUrl()}}"
            hx-select="#table-body-container>a"
            hx-swap="outerHTML"
            hx-trigger="intersect"
            hx-indicator="#loading-indicator"
        >
        </a>
        @endif
</x-slot>