<x-app-layout>
    <div x-data="{modal_open: false, name: ''}" class="w-full max-w-6xl mx-auto mt-3 p-5">
        <x-title>{{$rack->name}}</x-title>
        <div class="flex justify-between w-full">
            <x-title>Bijbehorende Planken</x-title>
            <x-new-button @click="modal_open = true"/>
        </div>

        <div class="grid grid-cols-1 auto-rows-max max-h-[20rem] w-full py-5 gap-y-2">
            @foreach ($rack->shelves()->get() as $shelf)
            <x-details-container x-data="{collapsed: false}" @click.outside="collapsed = false">
                <div @click="collapsed = !collapsed">
                    <x-title>{{$shelf->name}}</x-title>
                    <div class="flex justify-end w-full">
                        <p>
                            <i x-show="!collapsed" class="fa-solid fa-caret-down"></i>
                            <i x-show="collapsed" class="fa-solid fa-caret-up"></i>
                        </p>
                    </div>
                    @foreach($shelf->components()->get() as $component)
                    @endforeach
                </div>
            </x-details-container>
            @endforeach
        </div>

        <x-new-modal title="Nieuwe plank" :submit_post="route('planks.store', $rack->id)" submit_include="[name='name']" target="#name_error" x-on:close="name=''">
            <x-input-label for="name">Naam</x-input-label>
            <x-error-message id="name_error"></x-error-message>
            <x-text-input x-model="name" name="name" id="name" placeholder="Patrick" />
        </x-new-modal>
    </div>
</x-app-layout>