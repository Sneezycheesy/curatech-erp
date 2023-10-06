<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Component;
use App\Models\Rack;
use App\Models\Shelf;

class ShelfController extends Controller
{
    public function options($id, Request $rq) {
        return view('shelves.partials.options', [
            'shelves' => Shelf::where('rack_id', $id)
            ->get(),
        ]);
    }
    //
    public function store($id, Request $rq) {
        if (!isset($rq->name)) {
            return '*Verplicht veld';
        }
        $planks = Rack::find($id)->shelves()->pluck('name')->toArray();
        if (in_array($rq->name, $planks)) {
            return '*Een plank met deze naam bestaat al voor deze stelling';
        }

        Shelf::create([
            'name' => $rq->name,
            'rack_id' => $id,
        ]);

        return redirect(route('racks.details', $id));
    }
}
