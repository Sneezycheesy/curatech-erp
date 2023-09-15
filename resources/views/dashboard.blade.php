<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-cols justify-around py-12 mx-auto max-w-xl">
        <a href="/curatech_products" class="w-32 h-28 py-6 sm:px-6 lg:px-8 dark:bg-gray-700 dark:text-white rounded-xl bg-red-300 hover:bg-red-600 hover:text-white">
            <div>
                <p class="text-center">Curatech Products</p>
            </div>
        </a>

        <a href="{{route('components')}}" class="w-32 h-28 py-6 sm:px-6 lg:px-8 dark:bg-gray-700 dark:text-white rounded-xl bg-red-300 hover:bg-red-600 hover:text-white">
            <div>
                <p class="text-center">Componenten</p>
            </div>
        </a>

        <a href="/purchases" class="w-32 h-28 py-6 sm:px-6 lg:px-8 dark:bg-gray-700 dark:text-white rounded-xl bg-red-300 hover:bg-red-600 hover:text-white">
            <div>            
                <p class="text-center">Purchases</p>
            </div>
        </a>

        <a href="{{route('vendors')}}" class="w-32 h-28 py-6 sm:px-6 lg:px-8 dark:bg-gray-700 dark:text-white rounded-xl bg-red-300 hover:bg-red-600 hover:text-white">
            <div>            
                <p class="text-center">Leveranciers</p>
            </div>
        </a>
    </div>
</x-app-layout>
