<x-app-layout>
    <div class="w-full max-w-6xl mx-auto mt-3 bg-cbg-200 dark:bg-cbg-800 px-5 py-2">        
        <x-title>Voorraad aanvullen voor artikel {{$id}}</x-title>
        @include('restocks.partials.restock-form')
    </div>
</x-app-layout>