<x-app-layout>
    <x-slot name="header">
        {{ __('Component: ' . $comp->component_id . ' (' . $comp->description . ')')}}
    </x-slot>
    <div class="relative">
        <div class="grid grid-cols-2 w-full sm:max-w-sm md:max-w-7xl mx-auto dark:bg-cbg-800 bg-cbg-200 dark:text-white p-5 rounded mt-5">
            <div class="grid grid-cols-1 text-center gap-y-3">
                <div>
                    <x-paragraph class="text-lg">Artikelnummer</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->component_id}}</x-paragraph>
                </div>
                <div>
                    <x-paragraph class="text-lg">Voorraad magazijn</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->stock}}</x-paragraph>
                </div>
                <div>
                    <x-paragraph class="text-lg">Voorraad machines</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->stock_machines}}</x-paragraph>
                </div>
                <div>
                    <x-paragraph class="text-lg">Leverbaar</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->courant ? 'Ja' : 'Neen'}}</x-paragraph>
                </div>
                <div>
                    <x-paragraph class="text-lg">Levertijd (in dagen)</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->time_to_delivery}}</x-paragraph>
                </div>
                <div>
                    <x-paragraph class="text-lg">Verpakt per</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->package_size}}</x-paragraph>
                </div>
                @if($comp->feed)
                <div>
                    <x-paragraph class="text-lg">Feed</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->feed}}</x-paragraph>
                </div>
                @endif
                <div>
                    <x-paragraph class="text-lg">Beschrijving</x-paragraph>
                    <x-paragraph class="text-xl">{{$comp->description}}</x-paragraph>
                </div>
            </div>

            @include('curatech_components.partials.vendors', ['disabled' => $disabled])
        </div>

        <div class="flex justify-end w-full max-w-7xl py-5 mx-auto" x-data="{open_writeoff_modal: false, component_id: 0}">
            <x-primary-button class="mr-2" onclick="browseTo('/restocks/{{$comp->component_id}}/create')"><i class="fa-solid fa-wallet"></i></x-primary-button>
            <x-primary-button class="mr-2" @click="open_writeoff_modal = true"><i class="fa-solid fa-arrow-down"></i></x-primary-button>
            <x-edit-button onclick="browseTo('/components/edit/{{$comp->component_id}}')" class="w-max"></x-edit-button>
            @include('curatech_components.partials.write-off-modal')
        </div>

        <div class="grid grid-cols-2 w-full max-w-7xl mx-auto">
            @if (count($linked_shelves))
            <div class="w-full max-w-7xl max-h-[50rem] mx-auto">
                <div class="flex justify-between w-full">
                    <x-title>Te vinden in</x-title>
                </div>
        
                <div class="grid grid-cols-3 gap-3">
                    @foreach ($linked_shelves as $shelf)
                        <x-details-container class="mt-2 grid grid-cols-1">
                            <p>Magazijn: {{$shelf->rack()->first()->stockroom()->first()->name}}</p>
                            <p>Stelling: {{$shelf->rack()->first()->name}}</p>
                            <p>Plank: {{$shelf->name}}</p>
                        </x-details-container>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($purchase_history))
            <div class="grid grid-cols-1 gap-2 max-h-[50rem] overflow-y-scroll">
                <x-title class="col-span-3 sticky">Aankoopgeschiedenis</x-title>
                <div class="grid grid-cols-3 gap-2 max-h-[50rem] overflow-y-scroll p-2 scrollbar-hide">
                @foreach($purchase_history as $purchase)
                    <x-details-container>
                        <x-paragraph>{{$purchase['type'] == 'write_off' ? 'Afgeboekt' : 'Ingekocht'}}</x-paragraph>
                        <x-paragraph>Aantal: {{$purchase['pivot']['amount'] ?? $purchase['amount']}}</x-paragraph>
                        <x-paragraph>Apparaat: {{isset($purchase['curatech_product']) ? $purchase['curatech_product']['name'] : '-' }}</x-paragraph>
                        <x-paragraph>Voorraad: {{$purchase['pivot']['new_stock'] ?? $purchase['new_stock']}}</x-paragraph>
                        <x-paragraph>{{date('Y-m-d', strtotime($purchase['created_at']))}}</x-paragraph>
                    </x-details-container>
                @endforeach
                </div>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>