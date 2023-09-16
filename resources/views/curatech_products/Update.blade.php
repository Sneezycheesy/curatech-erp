<x-app-layout>
    <div class=" dark:text-white py-6 max-w-7xl mx-auto">
        <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
        <div class="dark:bg-gray-700 py-6 text-center max-w-xl mx-auto">
            <form method="post" id="update_curatech_product_form">
                @csrf
                <div class="grid grid-cols-1 grid-flow-cols gap-2 px-7">
                    <label for="curatech_product_id">Productnummer</label>
                    @error('curatech_product_id')
                    <div class="text-red-700">
                        {{$message}}
                    </div>
                    @enderror
                    <x-text-input type="text" name="curatech_product_id" id="curatech_product_id" class="text-black">{{$curatech_product->curatech_product_id}}</x-text-input>
                    
                    <label for="name">Naam</label>
                    @error('name')
                        <div class="text-red-700">
                            {{$message}}
                        </div>
                    @enderror
                    <x-text-input type="text" name="name" id="name" class="text-black">{{$curatech_product->name}}</x-text-input>
                    
                    <label for="description">Beschrijving</label>
                    @error('description')
                    <div class="text-red-700">
                        {{$message}}
                    </div>
                    @enderror
                    <textarea name="description" id="description" class="text-black h-[120px]">{{$curatech_product->description}}</textarea>

                    <input type="submit" class="mt-3 p-5 w-full dark:bg-gray-800 rounded hover:bg-red-700" value="Opslaan"/>
                    <div class="mt-2 p-2 w-full text-green-500 text-2xl">
                        {{session('success')}}
                    </div>
                </div>
            </form>
        </div>

        <div class="grid w-full grid-cols-7 grid-flow-cols auto-grid-rows overflow-y-scroll mt-6 gap-x-2 text-center">
            <!-- Show a selectbox that allows the user to add EXISTING components to the product -->
            <form method="post" action="{{route('curatech_product_add_component', $curatech_product->curatech_product_id)}}" class="grid grid-cols-7 gap-x-2 col-span-7 w-full">
                @csrf
                <select name="component_id" id="component_add_id_selector" class="col-span-6 text-black">
                    @foreach($all_components as $component)
                        {{dump($component)}}
                        <option value="{{$component->component_id}}">{{$component->component_id}} - {{$component->description}}</option>
                    @endforeach
                </select>
                <input type="submit" value="Add" class="dark:bg-gray-700">
            </form>

            <!-- Display TABLE of linked COMPONENTS-->
            <div class="grid grid-cols-7 border-b-2 border-gray-700 col-span-7 mt-3">
                <div>ID</div>
                <div>Description</div>
                <div>Position</div>
                <div>Value</div>
                <div>Type</div>
                <div>Unit</div>
                <div>Acties</div>
            </div>

            @foreach ( $components as $component )
            <div class="grid col-span-7 grid-cols-7 hover:bg-red-700">
                <div>{{$component->component_id}}</div>
                <div class="whitespace-nowrap overflow-x-hidden text-ellipsis">{{$component->description}}</div>
                <div>{{$component->pivot->curatech_product_component_position}}</div>
                <div>{{$component->component_value}}</div>
                <div>{{$component->component_type}}</div>
                <div>{{$component->component_unit}}</div>
                <form action="{{route('curatech_product_remove_component', $curatech_product->curatech_product_id)}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$component->component_id}}" name="component_id" />
                    <input type="submit" value="Verwijder" class="hover:cursor-pointer" />
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>