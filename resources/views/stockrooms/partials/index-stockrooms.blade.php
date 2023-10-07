@foreach($stockrooms as $stockroom)
    <x-details-container onclick="browseTo('/stockrooms/{{$stockroom->id}}/')">
        <x-details-container-title>{{$stockroom->name}}</x-details-container-title>
        <x-paragraph>{{$stockroom->location}}</x-paragraph>
    </x-details-container>
@endforeach