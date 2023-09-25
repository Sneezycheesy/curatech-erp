@php
    $i = false
@endphp

@foreach ($components as $comp)
    @php $i = !$i @endphp
    <div class="grid py-3 gap-x-1 grid-flow-col grid-cols-7 mx-auto text-center max-h-[400px] hover:bg-pimary-200 dark:hover:bg-pimary-500 {{$i ? 'bg-cbg-200 dark:bg-cbg-800' : 'bg-cbg-300 dark:bg-cbg-600'}}">
        <div class="items-end">
            <p class="hover:cursor-pointer hover:text-gray-400" hx-get="{{route('components.details', $comp->component_id)}}">{{$comp->component_id}}</p>
        </div>
        <div class="inline overflow-hidden">
            <p class="whitespace-nowrap overflow-hidden text-ellipsis" aria-label="{{$comp->description}}">{{$comp->description}}</p>
        </div>
        @if($comp->stock < $comp->required_stock())
        <div class="dark:text-red-400">
        @else
        <div class="dark:text-white">
        @endif
            <p>{{$comp->stock}}</p>
        </div>
        <div class="">
            <p>{{$comp->required_stock()}}</p>
        </div>
        <div class="max-h-[3rem] overflow-y-hidden whitespace-nowrap text-ellipsis">
            @foreach($comp->vendors()->get() as $vendor)
                <p>{{$vendor->name}}</p>
            @endforeach
        </div>
        <div>
        @foreach($comp->vendors()->get() as $vendor)
                <x-paragraph>
                    €{{$vendor->pivot->component_unit_price}}
                </x-paragraph>
            @endforeach
        </div>
        <div>
            <p hx-get="{{route('components.restock', $comp->component_id)}}"><i class="fa-solid fa-hand-holding-dollar hover:text-gray-400 hover:cursor-pointer"></i></p>
        </div>
    </div>
@endforeach