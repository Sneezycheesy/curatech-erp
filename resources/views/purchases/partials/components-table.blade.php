@php
    $i = false
@endphp

@foreach ($components as $component)
    @php $i = !$i @endphp
    <div class="grid py-3 gap-x-1 grid-flow-col grid-cols-6 mx-auto text-center max-h-[400px] hover:bg-red-200 {{$i ? 'bg-gray-200 dark:bg-gray-700' : 'bg-gray-300 dark:bg-gray-600'}}">
        <div class="items-end">
            <p class="hover:cursor-pointer hover:text-gray-400" hx-get="{{route('components.details', $component->component_id)}}">{{$component->component_id}}</p>
        </div>
        <div class="inline overflow-hidden">
            <p class="whitespace-nowrap overflow-hidden text-ellipsis" aria-label="{{$component->description}}">{{$component->description}}</p>
        </div>
        @if($component->stock < $component->required_stock())
        <div class="dark:text-red-400">
        @else
        <div class="dark:text-white">
        @endif
            <p>{{$component->stock}}</p>
        </div>
        <div class="">
            <p>{{$component->required_stock()}}</p>
        </div>
        <div class="max-h-[3rem] overflow-y-hidden whitespace-nowrap text-ellipsis">
            @foreach($component->vendors()->get() as $vendor)
                <p>{{$vendor->name}}</p>
            @endforeach
        </div>
        <div>
            <p><a href="{{route('components.restock', $component->component_id)}}"><i class="fa-solid fa-wallet hover:text-gray-400"></i></a></p>
        </div>
    </div>
        <!-- Display desired component fields to display
            - ID
            - Description
            - Stock
            - Supplier(s)
            - Unit Price
            - Feed
            - Desired (based off product stock)
            - Shortage (current stock - desired)
            - Current stock
            - Amount to order (possibly based off packaging style)
            - Total order price
            - Total current stock price (amount of components in stock * unit price)
        -->
@endforeach