<x-app-layout>
    <div class="w-full max-w-7xl p-5 mx-auto">
        <x-edit-button hx-get="{{route('components.edit', $comp->component_id)}}" class="w-full"></x-edit-button>
    </div>

    <div class="w-full sm:max-w-sm max-w-7xl mx-auto dark:text-white">
        <!-- Container for information fields article nr, courant, lt, stock,description-->

        <!-- Container for list of vendors-->
    </div>
</x-app-layout>