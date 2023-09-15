<x-app-layout>
<form action="/components/update/{{$comp->component_id}}">
    <input type="number" placeholder="Aantal"/>
    <input type="text" placeholder="Ordernr." />
    <select>
        @foreach($comp->vendors as $vendor)
        <option>$vendor->name</option>
        @endforeach
    </select>

    <input class="dark:text-white dark:bg-gray-700 p-4 rounded" type="submit" value="Update" />
</form>
</x-app-layout>