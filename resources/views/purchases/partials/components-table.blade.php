@php
    $i = false
@endphp

@foreach ($components as $comp)
    @php $i = !$i @endphp
    <div class="grid py-3 gap-x-1 grid-flow-col grid-cols-8 mx-auto text-center max-h-[400px] hover:bg-pimary-200 dark:hover:bg-pimary-500 {{$i ? 'bg-cbg-200 dark:bg-cbg-800' : 'bg-cbg-300 dark:bg-cbg-600'}}">
        <div class="items-end">
            <x-paragraph class="hover:cursor-pointer hover:text-primary-200" hx-get="{{route('components.details', $comp->component_id)}}">{{$comp->component_id}}</x-paragraph>
        </div>
        <div class="inline overflow-hidden">
            <x-paragraph class="whitespace-nowrap overflow-hidden text-ellipsis" aria-label="{{$comp->description}}">{{$comp->description}}</x-paragraph>
        </div>
        <div>
            <x-paragraph class="{{$comp->stock < $comp->required_stock() || $comp->stock == '' ? 'dark:text-red-400' : 'text-paragraph-200'}}">{{$comp->stock}} {{$comp->stock < $comp->required_stock() ? '(' . $comp->required_stock() - $comp->stock . ')' : ''}}</x-paragraph>
        </div>
        <div class="">
            <x-paragraph>{{$comp->required_stock()}}</x-paragraph>
        </div>
        <div class="max-h-[3rem] overflow-y-hidden whitespace-nowrap text-ellipsis">
            @foreach($comp->vendors()->get() as $vendor)
                <x-paragraph>{{$vendor->name}}</x-paragraph>
            @endforeach
        </div>
        <div class="max-h-[3rem] overflow-y-hidden whitespace-nowrap text-ellipsis">
            @foreach($comp->vendors()->get() as $vendor)
                <x-paragraph>
                    {{$vendor->pivot->vendor_product_nr}}
                </x-paragraph>
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
            <p hx-get="{{route('components.restock', $comp->component_id)}}"><i class="fa-solid fa-hand-holding-dollar hover:text-primary-200 hover:cursor-pointer"></i></p>
        </div>
    </div>
@endforeach