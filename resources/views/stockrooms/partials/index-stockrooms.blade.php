@foreach($stockrooms as $stockroom)
    <div hx-get="{{route('stockrooms.details', $stockroom->id)}}" class="w-full p-3 dark:bg-gray-700 bg-gray-200 rounded hover:cursor-pointer hover:dark:bg-gray-600 hover:bg-gray-100">
        <p>{{$stockroom->name}} | {{$stockroom->location}}</p>
    </div>
@endforeach