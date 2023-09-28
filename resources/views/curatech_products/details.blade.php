<x-app-layout>
    <div class=" dark:text-white py-6 max-w-7xl mx-auto">
        
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
                    <form>
                        @csrf
                        <x-primary-button type="button" hx-post="{{route('curatech_products.duplicate', $curatech_product->curatech_product_id)}}"><i class="fa-solid fa-copy"></i></x-primary-button>
                        <x-edit-button type="button" hx-get="{{route('curatech_products.edit', $curatech_product->curatech_product_id)}}" class="w-max" type="button">Wijzigen</x-edit-button>
                    </form>
                </div>
            </div>
            <div class="grid w-full grid-cols-3 auto-grid-rows overflow-y-scroll text-center h-max">
                @include('curatech_products.partials.components-table', ['disabled' => true])
            </div>
        </div>
    </div>
</x-app-layout>