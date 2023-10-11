@php
    use \App\Models\CuratechProduct;
    $curatech_products = CuratechProduct::all();
@endphp

<div x-cloak x-show="open_writeoff_modal"
    x-transition:enter="transition ease-in duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-out duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <x-backdrop />
    <div class="fixed top-1/3 left-1/2 -translate-y-1/2 -translate-x-1/2 w-1/4 bg-cbg-300 dark:bg-cbg-900 p-5 rounded"  @click.outside="open_writeoff_modal = false">
        <form method="PUT" action="">
            @csrf
            <x-title>Afboeken</x-title>
            <x-input-label>Curatech product</x-input-label>
            <x-select-box class="w-full" name="curatech_product_id">
                <x-slot name="options">
                @if($curatech_product)
                    <option value="{{$curatech_product->curatech_product_id}}" :selected="curatech_product_id == '{{$curatech_product->curatech_product_id}}'">{{$curatech_product->name}}</option>
                @else
                @foreach($curatech_products as $cp)
                    <option value="{{$cp->curatech_product_id}}" :selected="curatech_product_id == '{{$cp->curatech_product_id}}'">{{$cp->name}}</option>
                @endforeach
                @endif
                </x-slot>
            </x-select-box>
            <x-input-label>Aantal af te boeken</x-input-label>
            <x-error-message id="amount_error" class="my-2"></x-error-message>
            <x-text-input class="w-full" name="amount"/>

            <x-input-label>Productiestap</x-input-label>
            <x-select-box name="production_step" class="w-full">
                <x-slot name="options">
                    <option value="SMD">SMD</option>
                    <option value="ASSEMBLY">Assemblage</option>
                </x-slot>
            </x-select-box>

            <div class="flex w-full justify-end mt-3">
                <x-primary-button hx-post="{{route('writeoffs.store')}}" hx-target="#amount_error" hx-refresh="true" class="mr-2">OK</x-primary-button>
                <x-primary-button type="button" @click="open_writeoff_modal = false">X</x-primary-button>
            </div>
        </form>
    </div>
</div>
