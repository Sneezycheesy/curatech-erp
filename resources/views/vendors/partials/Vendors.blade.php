<ul id="vendors_container" class="w-3/4 mx-auto mt-3 p-5 grid grid-cols-4 gap-3">
    @foreach($vendors as $vendor)
        <li hx-get="{{route('vendors.details', $vendor->id)}}" class="grid grid-cols-1 auto-rows-max p-3 dark:bg-gray-700 dark:text-white bg-gray-300 w-full rounded hover:cursor-pointer hover:dark:bg-gray-800 hover:bg-gray-400">
            <h1 class="text-xl dark:text-red-400 text-red-700 font-bold">{{$vendor->name}}</h1>
            <p>{{$vendor->address}}</p>
            <p class="dark:text-gray-300">{{$vendor->zipcode}}, {{$vendor->city}}{{isset($vendor->country) ? ', ' . $vendor->country : ''}}</p>
        </li>
    @endforeach
</ul>