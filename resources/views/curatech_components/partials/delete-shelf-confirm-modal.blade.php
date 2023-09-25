<div x-show="delete_modal_open" class="hover:cursor-default"
    x-transition:enter="transition linear duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition linear duration-250"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="absolute w-full h-full top-0 left-0 bg-white opacity-25">
    </div>
    <div class="bg-cbg-200 dark:bg-cbg-900 p-4 absolute w-1/4 rounded h-max place-self-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" @click.outside="delete_modal_open = false">
        Weet je zeker dat je plank {{$shelf->name}} wilt ontkoppelen?
        <div class="flex w-full justify-end mt-3">
            <form method="post" action="">
                @csrf
                <x-primary-button type="button" class="mr-2" 
                hx-delete="{{route('components.shelf.remove', [$comp->component_id, $shelf->id])}}" 
                hx-include="[name= 'shelf_id']"
                hx-target="#shelf_container_{{$shelf->id}}"
                hx-swap="outerHTML">
                    Y
                </x-primary-button>
                <x-primary-button type="button" @click="delete_modal_open = false">N</x-primary-button>
            </form>
        </div>
    </div>
</div>