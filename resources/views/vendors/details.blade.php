<x-app-layout>
    <div class="flex justify-start max-w-7xl w-full mx-auto p-5 mt-5 rounded-xl">
        <x-back-button :url="route('vendors')"/>
        <x-edit-button hx-get="{{route('vendors.edit', $vendor->id)}}" class="max-w-md w-max" />
    </div>
    @include('vendors.partials.details')
    
</x-app-layout>