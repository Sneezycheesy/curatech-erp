<div x-show="open_writeoff_modal"
    x-transition:enter="transition ease-in duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-out duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <x-backdrop />
    <div class="absolute top-1/3 left-1/2 -translate-y-1/2 -translate-x-1/2 w-1/4 bg-cbg-200 dark:bg-cbg-900 p-5"  @click.outside="open_writeoff_modal = false">
        <form method="PUT" action="">
            @csrf
            <x-title>Afboeken</x-title>
            <x-input-label>Curatech product</x-input-label>
            <x-select-box class="w-full" name="curatech_product_id">
                <x-slot name="options">
                @foreach($curatech_products as $curatech_product)
                    <option value="{{$curatech_product->curatech_product_id}}" :selected="curatech_product_id == {{$curatech_product->curatech_product_id}}">{{$curatech_product->name}}</option>
                    @endforeach
                </x-slot>
            </x-select-box>
            <x-input-label>Aantal af te boeken</x-input-label>
            <x-error-message id="amount_error"></x-error-message>
            <x-text-input class="w-full" name="amount"/>
            <div class="flex w-full justify-end mt-3">
                <x-primary-button hx-put="" hx-target="#amount_error" class="mr-2">OK</x-primary-button>
                <x-primary-button type="button" @click="open_writeoff_modal = false">X</x-primary-button>
            </div>
        </form>
    </div>
</div>
