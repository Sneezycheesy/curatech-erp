<x-app-layout>
    <div class=" dark:text-white py-6 mx-auto grid grid-cols-5 px-4">
        <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
        <div class="dark:bg-gray-700 py-6 col-span-2">
            <form method="post" id="update_curatech_product_form">
                @csrf
                <div class="grid grid-cols-1 grid-flow-cols gap-2 px-7">
                    <label for="curatech_product_id">Productnummer</label>
                    @error('curatech_product_id')
                    <div class="text-red-700">
                        {{$message}}
                    </div>
                    @enderror
                    <x-text-input type="text" name="curatech_product_id" id="curatech_product_id" class="text-black" value="{{$curatech_product->curatech_product_id}}" />
                    
                    <label for="name">Naam</label>
                    @error('name')
                        <div class="text-red-700">
                            {{$message}}
                        </div>
                    @enderror
                    <x-text-input type="text" name="name" id="name" class="text-black" value="{{$curatech_product->name}}" />
                    
                    <label for="description">Beschrijving</label>
                    @error('description')
                    <div class="text-red-700">
                        {{$message}}
                    </div>
                    @enderror
                    <x-text-area-input name="description" id="description" class="text-black h-[120px]">{{$curatech_product->description}}</x-text-area-input>

                    <div class="flex justify-end mt-3">
                        <x-primary-button hx-get="{{route('curatech_product_details', $curatech_product->curatech_product_id)}}">Annuleer</x-primary-button>
                        <x-primary-button type="submit" class="ml-2 {{session('success') ? 'dark:bg-green-400 bg-green-400' : ''}}">Opslaan @if(session('success')) <i class="fa-solid fa-check ml-2"></i>  @endif</x-primary-button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-span-3 grid w-full grid-cols-7 grid-flow-cols auto-rows-max overflow-y-scroll gap-y-3 px-3 gap-x-2 text-center">
            <!-- Show a selectbox that allows the user to add EXISTING components to the product -->
            <form method="post" action="{{route('curatech_product_add_component', $curatech_product->curatech_product_id)}}" class="grid grid-cols-7 gap-x-2 col-span-7 w-full h-max">
                @csrf
                <label for="component_add_id_selector" class="col-span-4">Component</label>
                <label for="curatech_product_component_position" class="col-span-2">Positie</label>
                <x-select-box name="component_id" id="component_add_id_selector" class="col-span-4 text-black">
                    <x-slot name="trigger">
                        <x-text-input value="Component" />
                    </x-slot>
                    <x-slot name="options">
                        @foreach($all_components as $component)
                            <option value="{{$component->component_id}}">{{$component->component_id}} - {{$component->description}}</option>
                        @endforeach
                    </x-slot>
                </x-select-box>
                <x-text-input name="curatech_product_component_position" value="{{old('curatech_product_component_position')}}" placeholder="Positie" class="col-span-2" />
                <x-primary-button type="submit" class="text-3xl"><i class="fa-solid fa-plus"></i></x-primary-button>
            </form>

            @error('curatech_product_component_position')
            <p class="col-span-7 text-red-500 w-full text-center">{{$message}}</p>
            @enderror

            <!-- Display TABLE of linked COMPONENTS-->
            <div class="grid grid-cols-7 border-b-2 border-gray-700 col-span-7">
                <div>ID</div>
                <div class="col-span-4">Description</div>
                <div>Position</div>
                <div>Acties</div>
            </div>

            <div class="col-span-7 grid grid-cols-7 max-h-[400px] gap-y-2 overflow-y-scroll">
                @foreach ( $components as $component )
                <div class="grid col-span-7 grid-cols-7 hover:bg-red-700">
                    <div>{{$component->component_id}}</div>
                    <div class="col-span-4 whitespace-nowrap overflow-x-hidden text-ellipsis">{{$component->description}}</div>
                    <div>{{$component->pivot->curatech_product_component_position}}</div>
                    <form action="{{route('curatech_product_remove_component', $curatech_product->curatech_product_id)}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$component->id}}" name="component_id" />
                        <input type="hidden" value="{{$component->pivot->curatech_product_component_position}}" name="curatech_product_component_position" />
                        <input type="submit" value="Verwijder" class="hover:cursor-pointer" />
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="delete_prompt"></div>
</x-app-layout>