<x-app-layout>
    <x-slot name="header">
        {{ __('Product: ' . $curatech_product->name . ' (' . $curatech_product->curatech_product_id . ')')}}
    </x-slot>
    <div class="relative dark:text-white py-6 max-w-7xl mx-auto">
        
        <div class="grid grid-cols-2 w-full max-w-7xl gap-x-4 bg-cbg-200 dark:bg-cbg-600 p-4 rounded-xl">
            <div class="grid auto-rows-max gap-y-3 pt-6 w-3/4 mx-auto">
                <div class="grid grid-cols-1 gap-y-3">
                <div class="grid grid-cols-1 px-3">
                    <x-paragraph class="text-lg">Productnummer</x-paragraph>
                    <x-paragraph class="text-xl">{{ $curatech_product->curatech_product_id }}</x-paragraph>
                </div>
                <div class="grid grid-cols-1 px-3">
                    <x-paragraph class="text-lg">Naam</x-paragraph>
                    <x-paragraph class="text-xl">{{ $curatech_product->name }}</x-paragraph>
                </div>
                <div class="grid grid-cols-1 px-3 items-top">
                    <x-paragraph class="text-lg">Beschrijving</x-paragraph>
                    <x-paragraph class="text- max-h-[8rem] overflow-y-auto scrollbar-hide">{{ $curatech_product->description }}</x-paragraph>
                </div>
                @if($desired_stock)
                <div class="grid grid-cols-1 px-3 items-top">
                    <x-paragraph class="text-lg"><a href="{{route('desired_stocks.details', $desired_stock)}}">Gewenste voorraad</a></x-paragraph>
                    <x-paragraph class="text-xl">{{ $desired_stock->amount_initial }}</x-paragraph>
                    <x-paragraph class="text-lg">Geldig t/m</x-paragraph>
                    <x-paragraph class="text-xl">{{ date('d-m-Y', strtotime($desired_stock->expiration_date)) }}</x-paragraph>
                </div>
                @endif
            </div>
                <div class="flex justify-end col-span-2 w-full px-3">
                    <x-back-button :url="route('curatech_products')"></x-back-button>
                    <x-edit-button onclick="browseTo('/curatech_products/{{$curatech_product->curatech_product_id}}/edit')" class="w-max" type="button">Wijzigen</x-edit-button>
                </div>
            </div>
            <div class="grid w-full grid-cols-3 auto-grid-rows overflow-y-scroll text-center h-max">
                @include('curatech_products.partials.components-table', ['disabled' => true])
            </div>
        </div>

        <!-- show desired stocks, both future and past -->
        <div class="flex justify-between w-full p-3 mt-3" x-data="{open_new_desired_stock_modal: false}">
            <x-title>Productieschattingen</x-title>
            <x-new-button x-on:click="open_new_desired_stock_modal = true" />
            <x-modal-view name="new_desired_stock">
                <x-slot name="title">
                    Nieuwe Productieschatting
                </x-slot>
                <form class="w-1/2 mx-auto text-center" action="{{route('desired_stocks.store', $curatech_product)}}" 
                    hx-post="{{route('desired_stocks.store', $curatech_product)}}" 
                    hx-trigger="form.submit"
                    method="post">
                    @csrf
                    <x-input-label>Te maken aantal</x-input-label>
                    <x-text-input class="w-full" name="amount_initial"></x-text-input>

                    <x-input-label class="mt-3">Startdatum</x-input-label>
                    <x-text-input type="date" class="w-full" value="{{now()->format('Y-m-d')}}" min="{{now()->format('Y-m-d')}}" name="start_date" />

                    <x-input-label class="mt-3">Verloopdatum</x-input-label>
                    <x-text-input type="date" class="w-full" value="{{now()->addDays(1)->format('Y-m-d')}}" name="expiration_date" min="{{date('Y-m-d', strtotime(now()->addDays(1)))}}" />

                    <x-primary-button class="mt-3">Opslaan</x-primary-button>
                </form>
            </x-modal-view>
        </div>

        <x-index-container class="md:grid-cols-4 p-3">
            @foreach($curatech_product->desiredStocks()->get() as $ds)
            <a href="{{route('desired_stocks.details', $ds)}}">
                <x-details-container class="{{$ds->start_date <= now() && $ds->expiration_date >= now() ? 'border-b-2 border-green-500 hover:border-none' : ''}}">
                    <x-details-container-title>{{$ds->amount_initial}} | {{$ds->amount_made}} | {{$ds->amount_to_make}}</x-details-container-title>
                    <x-paragraph>{{$ds->start_date}}</x-paragraph>
                    <x-paragraph>{{$ds->expiration_date}}</x-paragraph>
                </x-details-container>
            </a>
            @endforeach
        </x-index-container>

        <!-- Show purchases history -->
        <div class="max-w-7xl w-full bg-cbg-200 dark:bg-cbg-600 mt-3 rounded p-3" x-data="{open_writeoff_modal: false, curatech_product_id: 0}">
            <div class="flex justify-between w-full items-center" >
                <x-title>Gebruiksgeschiedenis</x-title>
                <x-new-button @click="open_writeoff_modal = true; curatech_product_id = {{$curatech_product->curatech_product_id}}" />
            </div>
            <div class="grid grid-cols-3 gap-2 auto-rows-max overflow-y-scroll max-h-[15rem] mt-2 p-2">
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