@props(['vendor_id' => isset($vendor_id) ? $vendor_id : null, 'amount' => isset($amount) ? $amount : null, 'success' => isset($success) ? $success : false])
<form id="restock_form">
    @csrf
    <div class="grid grid-cols-1 w-full max-w-6xl bg-cbg-200 dark:bg-cbg-700 mx-auto p-5 mt-6 gap-y-3">
        <x-input-label>Aantal</x-input-label>
        @if(isset($amount_error))
            <x-error-message class="text-red-500">{{$amount_error}}</x-error-message>
        @endif
        <x-text-input name="amount" value="{{$amount}}">{{$amount}}</x-text-input>
    
        <x-input-label>Leverancier</x-input-label>
        @if (isset($vendor_error))
            <x-error-message class="text-red-500">{{$vendor_error}}</x-error-message>
        @endif
        <x-select-box name="vendor_id">
            <!-- option for each available vendor/supplier -->
            <x-slot name="options">
                <option value="" selected>Kies een leverancier</option>
                @foreach($vendors as $vendor)
                    <option {{$vendor_id == $vendor->id ? 'selected' : ''}} value="{{$vendor->id}}">{{$vendor->name}}</option>
                @endforeach
            </x-slot>
        </x-select-box>
        <x-input-label>Factuurnummer (optioneel)</x-input-label>
        <x-text-input name="invoice"></x-text-input>
        <div class="flex w-full max-w-6xl justify-end">
            <x-back-button :url="url()->previous() == route('components.restock', $id) ? route('components.details', $id) : url()->previous()"></x-back-button>
            <x-primary-button hx-target="#restock_form" hx-post="{{route('restock', $id)}}" class="{{$success ? 'dark:bg-green-500' : ''}}">Opslaan</x-primary-button>
        </div>
    </div>
</form>