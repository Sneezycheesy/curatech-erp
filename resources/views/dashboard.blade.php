<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-4 max-w-7xl w-full mt-4 py-5 mx-auto text-center gap-x-5 gap-y-3">
        <a href="{{route('components')}}" class="flex items-center hover:bg-red-400 hover:black:bg-red-500 justify-center bg-red-200 w-full h-[100px] text-black dark:bg-red-600 dark:text-white">
            Componenten
        </a>
        <a href="{{route('curatech_products')}}" class="flex items-center hover:bg-red-400 hover:black:bg-red-500 justify-center bg-red-200 w-full h-[100px] text-black dark:bg-red-600 dark:text-white">
            Producten
        </a>
        <a href="{{route('vendors')}}" class="flex items-center hover:bg-red-400 hover:black:bg-red-500 justify-center bg-red-200 w-full h-[100px] text-black dark:bg-red-600 dark:text-white">
            Leveranciers
        </a>
        <a href="{{route('purchases')}}" class="flex items-center hover:bg-red-400 hover:black:bg-red-500 justify-center bg-red-200 w-full h-[100px] text-black dark:bg-red-600 dark:text-white">
            Inkoop (WIP)
        </a>
        <a href="{{route('stockrooms')}}" class="flex items-center hover:bg-red-400 hover:black:bg-red-500 justify-center bg-red-200 w-full h-[100px] text-black dark:bg-red-600 dark:text-white">
            Magazijnbeheer (WIP)
        </a>
    </div>
</x-app-layout>
