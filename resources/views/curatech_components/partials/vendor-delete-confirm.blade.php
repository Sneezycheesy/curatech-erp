<div x-cloak x-show="confirm_delete_modal_open"
    x-transition:enter="transition linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition linear duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <!-- Backdrop -->
    <div class="absolute w-full h-full top-0 left-0 bg-white dark:bg-cbg-900 opacity-25">
    </div>
    <div class="absolute p-3 top-1/2 left-1/2 transform -translate-y-full -translate-x-1/2 bg-cbg-300 dark:bg-cbg-900 max-w-md rounded"  @click.outside="confirm_delete_modal_open = false">
        <p class="mb-3">Weet u zeker dat u leverancier "{{$vendor->name}}" bij dit component wilt verwijderen?</p>
        <form class="flex w-full justify-end">
            @csrf
            <x-primary-button class="mr-2" hx-delete="{{route('components.removeVendor', [$comp->component_id, $vendor->id])}}" 
            hx-include="[name='vendor_id_{{$vendor->id}}']" hx-target="#vendor_listitem_{{$vendor->id}}" hx-swap="outerHTML">
                OK
            </x-primary-button>
            <x-primary-button @click="confirm_delete_modal_open = false">X</x-primary-button>
        </form>
    </div>
</div>