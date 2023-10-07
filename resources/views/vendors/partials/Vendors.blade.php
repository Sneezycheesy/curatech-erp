<x-index-container>
    @foreach($vendors as $vendor)
        <x-details-container onclick="browseTo('/vendors/{{$vendor->id}}')" class="grid grid-cols-1 auto-rows-max p-3 dark:bg-cbg-700 dark:text-white bg-cbg-300 w-full rounded hover:cursor-pointer hover:dark:bg-cbg-800 hover:bg-cbg-400">
            <x-details-container-title>{{$vendor->name}}</x-details-container-title>
            <p>{{$vendor->address}}</p>
            <p class="dark:text-paragraph-300">{{$vendor->zipcode}}, {{$vendor->city}}{{isset($vendor->country) ? ', ' . $vendor->country : ''}}</p>
        </x-details-container>
    @endforeach
    
    @if($vendors->nextPageUrl())
    <div 
        hx-get="{{$vendors->nextPageUrl()}}"
        hx-select="#index-container>div"
        hx-swap="outerHTML"
        hx-trigger="intersect"
        hx-indicator="#loading-indicator"
    >
    </div>
    @endif
</x-index-container>