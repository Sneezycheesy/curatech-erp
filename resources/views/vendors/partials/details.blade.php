<div class="grid grid-cols-3 auto-rows-max w-full max-w-7xl bg-cbg-300 dark:bg-cbg-800 mx-auto py-5 mt-5 rounded-xl text-center">
    <!-- vendor details like name and address -->
    
    <div class="grid grid-cols-1 gap-y-4 px-2 h-max">
        <p class="text-2xl dark:text-gray-200">Gegevens</p>

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
    <div class="grid grid-cols-1 auto-rows-max col-span-2 px-2">
        <p class="text-2xl dark:text-cbg-200">Componenten</p>
        <ul class="grid grid-cols-3 text-center py-2 border-b-2 border-primary dark:text-white rounded-t">
            <li>Artikelnummer</li>
            <li>Beschrijving</li>
            <li>Stukprijs</li>
        </ul>

        @if(count($comps))
        <ul class="grid grid-cols-3 text-center dark:bg-cbg-800 max-h-[400px] overflow-y-scroll">
            @for($i = 0; $i < count($comps); $i++)
                <div class="col-span-3 {{$i % 2 ? 'bg-cbg-400 dark:bg-cbg-600' : 'bg-cbg-500 dark:bg-cbg-700'}} text-white grid grid-cols-3 py-1">
                    <li>{{$comps[$i]->component_id}}</li>
                    <li>{{$comps[$i]->description}}</li>
                    <li>€{{$comps[$i]->pivot->component_unit_price}}</li>
                </div>   
            @endfor
        </ul>
        @else
        <p class="text-2xl text-white w-full mx-auto">Er zijn geen componenten gekoppeld aan deze leverancier</p>
        @endif
    </div>
</div>