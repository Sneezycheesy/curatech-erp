<x-app-layout>
    <div class="relative dark:text-white py-6 max-w-7xl mx-auto">
        
        <div class="grid grid-cols-2 w-full max-w-7xl gap-x-4 bg-cbg-200 dark:bg-cbg-600 p-5 rounded-xl">
            <div class="grid grid-cols-2 auto-rows-max gap-y-3 py-6 w-3/4 mx-auto">
                <div class="col-span-2 grid grid-cols-1 px-3">
                    <x-input-label class="text-2xl">Naam</x-input-label>
                    <x-text-input disabled value="{{ $curatech_product->name }}" />
                </div>
                <div class="col-span-2 grid grid-cols-1 px-3 items-top">
                    <x-input-label class="text-2xl">Beschrijving</x-input-label>
                    <x-text-area-input disabled>{{ $curatech_product->description }}</x-text-area-input>
                </div>

                
                <div class="flex justify-end col-span-2 w-full px-3 pt-3">
                    <x-back-button :url="route('curatech_products')"></x-back-button>
                    <x-edit-button hx-get="{{route('curatech_product_update', $curatech_product->curatech_product_id)}}" class="w-max" type="button">Wijzigen</x-edit-button>
                </div>
            </div>
            <div class="grid w-full grid-cols-3 auto-grid-rows overflow-y-scroll text-center h-max">
                @include('curatech_products.partials.components-table', ['disabled' => true])
            </div>
        </div>

        <!-- Show purchases history -->
        <div class="max-w-7xl w-full bg-cbg-200 dark:bg-cbg-600 mt-3 rounded p-3" x-data="{open_writeoff_modal: false, curatech_product_id: 0}">
            <div class="flex justify-between w-full items-center" >
                <x-title>Gebruiksgeschiedenis</x-title>
                <x-new-button @click="open_writeoff_modal = true; curatech_product_id = {{$curatech_product->curatech_product_id}}" />
            </div>
            <div class="grid grid-cols-3 gap-2 auto-rows-max overflow-y-scroll max-h-[15rem] mt-2">
                @foreach($writeoffs as $writeoff)
                <x-details-container>
                    <x-title>Afgeboekt</x-title>
                    <x-paragraph>Aantal: {{$writeoff->amount}} | {{$writeoff->created_at->format('Y-m-d')}}</x-paragraph>
                </x-details-container>
                @endforeach
            </div>
            @include('purchases.partials.write-off-modal')
        </div>
    </div>
</x-app-layout>