<x-app-layout>
    <div class="relative">
        <div class="grid grid-cols-2 w-full sm:max-w-sm md:max-w-7xl mx-auto dark:bg-cbg-700 bg-cbg-200 dark:text-white p-5 rounded mt-5">
            @include('curatech_components.partials.edit-form', ['disabled' => $disabled])
            
            @include('curatech_components.partials.vendors', ['disabled' => $disabled])
        </div>

        <div class="flex justify-end w-full max-w-7xl py-5 mx-auto" x-data="{open_writeoff_modal: false, component_id: 0}">
            <x-primary-button class="mr-2" hx-get="{{route('restocks.create', $comp->component_id)}}"><i class="fa-solid fa-wallet"></i></x-primary-button>
            <x-primary-button class="mr-2" @click="open_writeoff_modal = true; component_id={{component->component_id}}"><i class="fa-solid fa-arrow-down"></i></x-primary-button>
            <x-edit-button hx-get="{{route('components.edit', $comp->component_id)}}" class="w-max"></x-edit-button>
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

            <div class="grid grid-cols-3 gap-2 max-h-[50rem] overflow-y-scroll">
            @if(count($purchase_history))
            <x-title class="col-span-3">Aankoopgeschiedenis</x-title>
            @foreach($purchase_history as $purchase)
                <x-details-container>
                    <x-paragraph>{{$purchase['type'] == 'write_off' ? 'Afgeboekt' : 'Ingekocht'}}</x-paragraph>
                    <x-paragraph>Aantal: {{$purchase['pivot']['amount'] ?? $purchase['amount']}}</x-paragraph>
                    <x-paragraph>Voorraad: {{$purchase['pivot']['new_stock'] ?? $purchase['new_stock']}}</x-paragraph>
                    <x-paragraph>{{date('Y-m-d', strtotime($purchase['created_at']))}}</x-paragraph>
                </x-details-container>
            @endforeach
            @endif
            </div>
        </div>
    </div>
</x-app-layout>