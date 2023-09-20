<x-app-layout>
        
    <div class="dark:bg-gray-700 mt-5 py-6 text-center max-w-6xl mx-auto px-6 gap-x-4 dark:text-white">
        <form method="post" id="update_curatech_product_form">
            @csrf
            <div class="grid grid-cols-1 grid-flow-cols gap-2 px-7">
                <label for="curatech_product_id">Productnummer</label>
                @error('curatech_product_id')
                <div class="text-red-700">
                    {{$message}}
                </div>
                @enderror
                <x-text-input type="text" name="curatech_product_id" id="curatech_product_id" class="text-black">{{old('curatech_product_id')}}</x-text-input>
                
                <label for="name">Naam</label>
                @error('name')
                    <div class="text-red-700">
                        {{$message}}
                    </div>
                @enderror
                <x-text-input type="text" name="name" id="name" class="text-black">{{old('name')}}</x-text-input>
                
                <label for="description">Beschrijving</label>
                @error('description')
                <div class="text-red-700">
                    {{$message}}
                </div>
                @enderror
                <textarea name="description" id="description" class="text-black h-[120px]">{{old('description')}}</textarea>

                <input type="submit" class="mt-3 p-5 w-full dark:bg-gray-800 rounded hover:bg-red-700" value="Opslaan"/>
                <div class="mt-2 p-2 w-full text-green-500 text-2xl">
                    {{session('success')}}
                </div>
            </div>
        </form>
    </div>
</x-app-layout>