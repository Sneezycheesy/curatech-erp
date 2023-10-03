@props(['disabled' => isset($disabled) ? true : false])

@if (!$disabled)
<form method="post" action="{{route('curatech_products.add_component', $curatech_product->curatech_product_id)}}" class="grid grid-cols-7 gap-x-2 w-full h-max">
    @csrf
    <label for="component_add_id_selector" class="col-span-4">Component</label>
    <label for="curatech_product_component_position" class="col-span-2">Positie</label>
    <x-select-box name="component_id" id="component_add_id_selector" class="col-span-4 text-black">
        <x-slot name="trigger">
            <x-text-input value="Component" />
        </x-slot>
        <x-slot name="options">
            @foreach($all_components as $component)
                <option value="{{$component->component_id}}">{{$component->component_id}} - {{$component->description}}</option>
            @endforeach
        </x-slot>
    </x-select-box>
    <x-text-input name="curatech_product_component_position" value="{{old('curatech_product_component_position')}}" placeholder="Positie" class="col-span-2" />
    <x-primary-button type="submit" class="text-3xl"><i class="fa-solid fa-plus"></i></x-primary-button>
</form>


@error('curatech_product_component_position')
<p class="col-span-7 text-red-500 w-full text-center">{{$message}}</p>
@enderror
@endif

<!-- Display TABLE of linked COMPONENTS-->
<div class="grid grid-cols-7 border-b-2 border-primary col-span-7">
    <div>ID</div>
    <div class="col-span-4">Beschrijving</div>
    <div class="{{$disabled ? 'col-span-2' : ''}}">Positie</div>
    @if(!$disabled)
    <div>Acties</div>
    @endif
</div>

@include('curatech_products.partials.components', ['disabled' => $disabled])