@php
    $i = false
@endphp

@foreach ($components as $comp)
    @php $i = !$i @endphp
    <div class="grid py-3 gap-x-1 grid-flow-col grid-cols-9 mx-auto text-center max-h-[400px] hover:bg-cbg-500 dark:hover:bg-cbg-500 {{$i ? 'bg-cbg-300 dark:bg-cbg-800' : 'bg-cbg-400 dark:bg-cbg-700'}}">
        <div class="items-end">
            <x-paragraph class="hover:cursor-pointer hover:text-primary-600" hx-get="{{route('components.details', $comp->component_id)}}">{{$comp->component_id}}</x-paragraph>
        </div>
        <div class="inline overflow-hidden">
            <x-paragraph class="whitespace-nowrap overflow-hidden text-ellipsis" aria-label="{{$comp->description}}">{{$comp->description}}</x-paragraph>
        </div>
        <div>
            <x-paragraph class="{{$comp->stock < $comp->required_stock() || $comp->stock == '' ? 'text-red-600 dark:text-red-600' : 'text-paragraph-200'}}">
                {{$comp->stock}} {{$comp->stock < $comp->required_stock() ? '(' . $comp->required_stock() - $comp->stock . ')' : ''}}
            </x-paragraph>
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
            <x-paragraph>
                €{{$comp->priceRequiredStock()}} 
            </x-paragraph>
        </div>
        <div>
            <x-paragraph>
                <i hx-get="{{route('restocks.create', $comp->component_id)}}" class="fa-solid fa-hand-holding-dollar hover:text-primary-600 hover:cursor-pointer mr-2"></i>
            </x-paragraph>
        </div>
    </div>
@endforeach

<!-- Display total price of all the required components -->
<div class="grid mt-5 gap-x-1 grid-flow-col grid-cols-9 h-max-h-400 mx-auto text-center">
    <div class="col-start-8">
        € {{$total_price}}
    </div>
</div>