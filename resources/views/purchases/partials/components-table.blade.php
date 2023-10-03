@php
    $i = false
@endphp

@foreach ($components as $comp)
    <x-table-row :counter="$i = !$i">
        <x-paragraph class="hover:cursor-pointer hover:text-primary-600" 
            hx-get="{{route('components.details', $comp->component_id)}}">
            {{$comp->component_id}}
        </x-paragraph>
        <x-paragraph class="whitespace-nowrap overflow-hidden text-ellipsis" 
            aria-label="{{$comp->description}}">
            {{$comp->description}}
        </x-paragraph>
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
        <!-- Voorraad -->
        <x-paragraph>
            {{$comp->stock}}
        </x-paragraph>

        <!-- minimaal nodige voorraad -->
        <x-paragraph>
            {{$comp->required_stock()}}
        </x-paragraph>

        <!-- Tekort -->        
        <x-paragraph>
            {{$comp->stock_shortage()}}
        </x-paragraph>

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
                <i hx-get="{{route('restocks.create', $comp->component_id)}}" 
                    class="fa-solid fa-hand-holding-dollar hover:text-primary-600 hover:cursor-pointer mr-2">
                </i>
            </x-paragraph>
        </div>
    </x-table-row>
@endforeach