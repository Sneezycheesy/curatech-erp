<div class="grid grid-cols-3 auto-rows-max w-full max-w-7xl bg-gray-400 dark:bg-gray-500 mx-auto py-5 mt-5 rounded text-center">
    <!-- vendor details like name and address -->
    
    <div class="grid grid-cols-1 gap-y-4 px-2 h-max">
        <p class="text-2xl text-red-500">Gegevens</p>

        <ul class="grid grid-cols-2 auto-rows-max gap-y-4 w-full max-w-3xl dark:text-white">
            
            <li>Naam</li>
            <li>{{$vendor->name}}</li>

            <li>Adres</li>
            <li>{{$vendor->address}}</li>

            <li>Postcode</li>
            <li>{{$vendor->zipcode}}</li>

            <li>Plaats</li>
            <li>{{$vendor->city}}</li>

            @if(isset($vendor->country))
            <li>Land</li>
            <li>{{$vendor->country}}</li>
            @endif
        </ul>
    </div>

    <!-- components linked to this vendor -->
    <div class="grid grid-cols-1 auto-rows-max gap-y-4 col-span-2 px-2">
        <p class="text-2xl text-red-500">Componenten</p>
        <ul class="grid grid-cols-3 text-center dark:bg-gray-800 py-2 dark:text-white rounded-t">
            <li>Artikelnummer</li>
            <li>Beschrijving</li>
            <li>Stukprijs</li>
        </ul>

        @if(count($comps))
        <ul class="grid grid-cols-3 text-center dark:bg-gray-800 py-2 max-h-[400px] overflow-y-scroll">
            @for($i = 0; $i < count($comps); $i++)
                <ul class="col-span-3 {{$i % 2 ? 'bg-gray-700' : 'bg-gray-800'}} text-white grid grid-cols-3">
                    <li>{{$comps[$i]->component_id}}</li>
                    <li>{{$comps[$i]->description}}</li>
                    <li>{{$comps[$i]->vendor_unit_price}}</li>
                </ul>   
            @endfor
        </ul>
        @else
        <p class="text-2xl text-white w-full mx-auto">Er zijn geen componenten gekoppeld aan deze leverancier</p>
        @endif
    </div>
</div>