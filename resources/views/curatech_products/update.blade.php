<x-app-layout>
    <div class=" dark:text-white py-6 mx-6 my-6 grid grid-cols-5 px-4 dark:bg-gray-700">
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
                        <x-primary-button hx-get="{{route('curatech_product_details', $curatech_product->curatech_product_id)}}">Terug</x-primary-button>
                        <x-primary-button type="submit" class="ml-2 {{session('success') ? 'dark:bg-green-400 bg-green-400' : ''}}">Opslaan @if(session('success')) <i class="fa-solid fa-check ml-2"></i>  @endif</x-primary-button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-span-3 grid w-full grid-cols-7 grid-flow-cols auto-rows-max overflow-y-scroll gap-y-3 px-3 gap-x-2 text-center">
            <!-- Show a selectbox that allows the user to add EXISTING components to the product -->
            <div class="col-span-7">
                @include('curatech_products.partials.components-table')
            </div>
        </div>
    </div>

    <div id="delete_prompt"></div>
</x-app-layout>