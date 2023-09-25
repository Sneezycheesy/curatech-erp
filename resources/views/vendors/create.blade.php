<x-app-layout>
    <div class="max-w-7xl w-7xl p-5 mt-3 text-center mx-auto bg-cbg-200 dark:bg-cbg-700 dark:text-white rounded">
        <h1 class="text-2xl mx-auto text-center mb-3">
            Leverancier toevoegen
        </h1>
        <form id="create_vendor_form" action="" method="post">
            @csrf
            <div class="grid grid-cols-2 grid-rows-1 w-full gap-x-4">
                <div class="grid grid-cols-1 gap-y-2 h-max">
                    <label for="vendor_name_input">Naam</label>
                    @error('name')
                        <p class="text-red-700 dark:text-red-400">{{$message}}</p>
                    @enderror
                    <input type="text" name="name" id="vendor_name_input" value="{{old('name')}}" placeholder="Naam leverancier" class="text-black w-full max-w-md mx-auto text-center rounded">
                    
                    <label for="vendor_address_input">Adres</label>
                    @error('address')
                        <p class="text-red-700 dark:text-red-400">{{$message}}</p>
                    @enderror
                    <input type="text" name="address" id="vendor_address_input" value="{{old('address')}}" placeholder="Adres leverancier" class="text-center text-black w-full max-w-md mx-auto"/>
                    
                    <label for="vendor_zipcode_input">Postcode</label>
                    @error('zipcode')
                        <p class="text-red-700 dark:text-red-400">{{$message}}</p>
                    @enderror
                    <input type="text" name="zipcode" id="vendor_zipcode_input" value="{{old('zipcode')}}" placeholder="Postcode leverancier" class="text-center text-black w-full max-w-md mx-auto"/>
                </div>

                <div class="grid grid-cols-1 gap-y-2 h-max">
                        <label for="vendor_city_input">Plaats</label>
                        @error('zipcode')
                            <p class="text-red-700 dark:text-red-400">{{$message}}</p>
                        @enderror
                        <input type="text" name="city" id="vendor_city_input" value="{{old('city')}}" placeholder="Stad leverancier" class="text-center text-black w-full max-w-md mx-auto"/>
                    
                        <label for="vendor_country_input">Land</label>
                        @error('country')
                            <p class="text-red-700 dark:text-red-400">{{$message}}</p>
                        @enderror
                        <input type="text" name="country" id="vendor_country_input" value="{{old('country')}}" placeholder="Land leverancier" class="text-center text-black w-full max-w-md mx-auto"/>
                </div>
            </div>

            <x-primary-button type="submit" class="w-full max-w-xl mx-auto rounded-xl mt-5 py-4">
                Opslaan
            </x-primary-button>
            <p class="mx-auto w-full max-w-xl text-green-500 no-select text-center mt-2">{{session()->get('success')}}</p>
        </form>
    </div>
</x-app-layout>