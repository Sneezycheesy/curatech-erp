<x-app-layout>
    <div class="grid grid-cols-1 auto-grid-rows w-full max-w-5xl text-center items-center mx-auto mt-5 py-3 dark:bg-gray-700 rounded">
        <form id="vendor_edit_form" method="post" action="{{route('vendors.update', $vendor->id)}}">
        @csrf
            <div class="grid grid-cols-4 auto-rows-max max-w-3xl mx-auto justify-center align-middle gap-x-3 gap-y-4">
                <x-input-label for="name" class="flex items-center text-xl dark:text-white">
                    Naam leverancier
                    @error('name')
                        <i>*</i>
                    @enderror
                </x-input-label>

                <div class="grid grid-cols-1 auto-rows-max col-span-3">
                    <x-text-input name="name" value="{{$vendor->name}}" class="text-center col-span-3"/>
                </div>

                <x-input-label for="address" class="flex items-center text-xl dark:text-white">
                    Adres
                    @error('address')
                        <i>*</i>
                    @enderror
                </x-input-label>
                <x-text-input name="address" class="text-center col-span-3" value="{{$vendor->address ?? old('address')}}" />
    
                <x-input-label for="zipcode" class="flex items-center text-xl dark:text-white">
                    Postcode
                    @error('zipcode')
                        <i>*</i>
                    @enderror
                </x-input-label>
                <x-text-input name="zipcode" class="text-center col-span-3" value="{{$vendor->zipcode ?? old('zipcode')}}" />
                    
                <x-input-label name="city" for="city" class="flex items-center text-xl dark:text-white">
                    Plaats
                    @error('city')
                        <i>*</i>
                    @enderror
                </x-input-label>
                <x-text-input name="city" class="text-center col-span-3" value="{{$vendor->city ?? old('city')}}" />

                <x-input-label for="country" class="flex items-center text-xl dark:text-white">
                    Land
                    @error('country')
                        <i>*</i>
                    @enderror
                </x-input-label>
                <x-text-input name="country" class="text-center col-span-3" value="{{$vendor->country ?? old('country')}}" placeholder="Land" />

                <x-delete-button hx-delete="{{route('vendors.delete', $vendor->id)}}" hx-confirm="Weet je het zeker?" 
                    class="w-min">
                    <i class="fa-solid fa-trash"></i>
                </x-delete-button>
                <div class="flex col-span-3 justify-end">
                    <x-back-button></x-back-button>
                    <x-primary-button type="submit" class="mr-3 justify-center">Opslaan</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>