<x-app-layout>
    <div class="grid grid-cols-1 w-full max-w-6xl bg-gray-200 dark:bg-gray-700 mx-auto p-5 mt-6 gap-y-3">
        <x-input-label>Aantal</x-input-label>
        <x-text-input></x-text-input>
    
        <x-input-label>Leverancier</x-input-label>
        <x-select-box>
            <!-- option for each available vendor/supplier -->
            <x-slot name="options" name="vendor_id">
                <option value="" selected>Kies een leverancier</option>
                @foreach($vendors as $vendor)
                    <option {{old('vendor_id') == $vendor->id ? 'selected' : ''}}>{{$vendor->name}}</option>
                @endforeach
            </x-slot>
        </x-select-box>
        <x-input-label>Factuurnummer (optioneel)</x-input-label>
        <x-text-input></x-text-input>
        <div class="flex w-full max-w-6xl justify-end">
            <x-primary-button hx-get="{{route('purchases')}}"  class="fa-solid fa-arrow-left mr-3"></x-primary-button>
            <x-primary-button>Opslaan</x-primary-button>
        </div>
    </div>
</x-app-layout>