@if (empty($shelves))
    <option value="">Selecteer een stelling</option>
@else
    <option value="">Selecteer een plank</option>
    @foreach($shelves as $shelf)
    <option value="{{$shelf->id}}">{{$shelf->name}}</option>
    @endforeach
@endif