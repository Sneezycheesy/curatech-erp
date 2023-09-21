<x-app-layout>
    <div class="flex justify-start max-w-7xl w-full mx-auto p-5 mt-5 rounded-xl">
        <x-back-button/>
        <x-edit-button hx-get="{{route('vendors.edit', $vendor->id)}}" class="max-w-md w-max">Wijzigen</x-edit-button>
    </div>
    @include('vendors.partials.details')
    
</x-app-layout>