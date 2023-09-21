<x-app-layout>
    <x-new-button :hx-get="route('stockrooms.create')" />
    @foreach($stockrooms as $stockroom)
        <p>Hello</p>
    @endforeach
</x-app-layout>