@if (empty($racks))
    <option value="">Selecteer een magazijn</option>
@else
    <option value="">Selecteer een stelling</option>
    @foreach($racks as $rack)
    <option value="{{$rack->id}}" hx-get="{{route('shelves.options', $rack->id)}}" hx-trigger="click" hx-target="#shelf_name">{{$rack->name}}</option>
    @endforeach
@endif