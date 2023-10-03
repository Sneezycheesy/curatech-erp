<ul id="vendors_container" class="max-w-7xl mx-auto mt-3 py-5 grid grid-cols-4 gap-3">
    @foreach($vendors as $vendor)
        <li hx-get="{{route('vendors.details', $vendor->id)}}" class="grid grid-cols-1 auto-rows-max p-3 dark:bg-cbg-700 dark:text-white bg-cbg-300 w-full rounded hover:cursor-pointer hover:dark:bg-cbg-800 hover:bg-cbg-400">
            <h1 class="text-xl dark:text-primary-400 text-primary-700 font-bold">{{$vendor->name}}</h1>
            <p>{{$vendor->address}}</p>
            <p class="dark:text-paragraph-300">{{$vendor->zipcode}}, {{$vendor->city}}{{isset($vendor->country) ? ', ' . $vendor->country : ''}}</p>
        </li>
    @endforeach
</ul>