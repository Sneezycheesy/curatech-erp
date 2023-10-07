<x-app-layout>
<x-slot name="header">
    Inkoop
</x-slot>
    <x-index-container-horizontal>
        @foreach($desired_stocks as $desired_stock)
        <x-details-container class="min-w-[20rem]">
            <x-details-container-title>
                {{$desired_stock->curatechProduct->name}}
            </x-details-container-title>
        </x-details-container>
        @endforeach
    </x-index-container-horizontal>
</x-app-layout>