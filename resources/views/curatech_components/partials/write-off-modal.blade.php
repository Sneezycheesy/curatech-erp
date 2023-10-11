@php
    use App\Models\Component;
    $components = Component::all();
@endphp

<div x-cloak x-show="open_writeoff_modal"
    x-transition:enter="transition ease-in duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-out duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <x-backdrop />
    <div class="fixed top-[8rem] left-1/2 -translate-x-1/2 w-1/4 bg-cbg-300 dark:bg-cbg-900 p-5 rounded"  @click.outside="open_writeoff_modal = false">
        <form method="POST" action="">
            @csrf
            <x-title>Afboeken</x-title>
            <x-input-label>Component</x-input-label>
            <x-select-box class="w-full" name="component_id">
                <x-slot name="options">
                    <option value="{{$comp->id}}">{{$comp->component_id}}</option>
                </x-slot>
            </x-select-box>
            <x-input-label>Aantal af te boeken</x-input-label>
            <x-error-message id="amount_error"></x-error-message>
            <x-text-input class="w-full" name="amount"/>

            <x-input-label>Gepakt van</x-input-label>
            <x-select-box class="w-full" name="stock_from"> <!-- Stockroom / machines -->
                <x-slot name="options">
                    <option value="STOCKROOM">Magazijn</option>
                    <option value="MACHINE">Machine</option>
                </x-slot>
            </x-select-box>
            <div class="flex w-full justify-end mt-3">
                <x-primary-button hx-post="{{route('writeoffs.store')}}" hx-target="#amount_error" hx-refresh="true" class="mr-2">OK</x-primary-button>
                <x-primary-button type="button" @click="open_writeoff_modal = false">X</x-primary-button>
            </div>
        </form>
    </div>
</div>