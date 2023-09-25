@foreach($stockrooms as $stockroom)
    <div hx-get="{{route('stockrooms.details', $stockroom->id)}}" class="w-full p-3 dark:bg-cbg-700 bg-cbg-200 rounded hover:cursor-pointer hover:dark:bg-cbg-800 hover:bg-cbg-100">
        <p>{{$stockroom->name}} | {{$stockroom->location}}</p>
    </div>
@endforeach