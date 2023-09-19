<x-app-layout>
    <div class="max-w-7xl w-full mx-auto p-5 mt-5 bg-gray-300 dark:bg-gray-700 rounded-xl text-center">
        <x-edit-button hx-get="{{route('vendors.edit', $vendor->id)}}" class="max-w-md mx-auto py-3 w-full">Wijzigen</x-edit-button>
    </div>
    
    @include('vendors.partials.details')
</x-app-layout>