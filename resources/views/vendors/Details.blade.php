<x-app-layout>
    <div class="max-w-7xl w-full mx-auto p-5 mt-5 bg-gray-300 dark:bg-gray-700 rounded-xl text-center">
        <form class="grid grid-cols-2 grid-rows-1">
            @csrf
            <button class="bg-gray-500 dark:bg-gray-900 max-w-md mx-auto py-3 text-white rounded w-full hover:bg-yellow-700">Wijzigen</button>
            
            <button hx-delete="{{route('vendors.delete', $vendor->id)}}" hx-confirm="Weet je het zeker?" 
                class="bg-gray-500 dark:bg-gray-900 max-w-md mx-auto py-3 text-white rounded w-full hover:bg-red-700">
                Verwijderen
            </button>
        </form>
    </div>
    
    @include('vendors.partials.details')
</x-app-layout>