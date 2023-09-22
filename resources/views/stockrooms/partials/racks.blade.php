<!-- foreach rack -->
<!-- Leads to rack details page | there will be NO rack index page as a rack is ALWAYS linked to a stockroom -->
@foreach ($racks as $rack)
    <x-details-container hx-get="{{route('racks.details', $rack->id)}}">
        <p>{{$rack->name}}</p>
        <p>Aantal planken</p>
    </x-details-container>
@endforeach