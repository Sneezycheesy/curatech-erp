@props(['disabled' => isset($disabled) ? true : false])
<div id="components_table" class="col-span-7 grid grid-cols-7 max-h-[400px] overflow-y-scroll">
    @for ($i = 0; $i < count($components); $i++)
    <div class="grid col-span-7 grid-cols-7 hover:bg-primary-700 hover:text-white p-1 {{$i % 2 ? 'bg-cbg-200 dark:bg-cbg-700' : 'bg-cbg-300 dark:bg-cbg-800'}}">
        <div>{{$components[$i]->component_id}}</div>
        <div class="col-span-4 whitespace-nowrap overflow-x-hidden text-ellipsis">{{$components[$i]->description}}</div>
        <div class="{{$disabled ? 'col-span-2' : ''}}">{{$components[$i]->pivot->curatech_product_component_position}}</div>

        @if(!$disabled)
        <form action="{{route('curatech_product_remove_component', $curatech_product->curatech_product_id)}}" method="post">
            @csrf
            <input type="hidden" value="{{$components[$i]->id}}" name="component_id" />
            <input type="hidden" value="{{$components[$i]->pivot->curatech_product_component_position}}" name="curatech_product_component_position" />
            <i hx-delete="{{route('curatech_product_remove_component', $curatech_product->curatech_product_id)}}" hx-target="#components_table" class="fa-solid fa-trash hover:cursor-pointer hover:text-primary-200"></i>
        </form>
        @endif
    </div>
    @endfor
</div>