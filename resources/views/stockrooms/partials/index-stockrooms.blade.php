@foreach($stockrooms as $stockroom)
    <x-details-container hx-get="{{route('stockrooms.details', $stockroom->id)}}">
        <p>{{$stockroom->name}} | {{$stockroom->location}}</p>
    </x-details-container>
@endforeach