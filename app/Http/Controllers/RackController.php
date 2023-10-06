<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rack;
use App\Models\Stockroom;

class RackController extends Controller
{
    public function options($id) {
        return view('racks.partials.options', [
            'racks' => Stockroom::find($id)->racks()->get(),
        ]);
    }
    //
    public function details($id, Request $rq) {
        return view('racks.details', [
            'rack' => Rack::find($id),
        ]);
    }

    public function store($id, Request $rq) {
        if (!isset($rq->name)) {
            return '*Verplicht veld';
        }

        $racks = Stockroom::find($id)->racks()->pluck('name')->toArray();
        if (in_array($rq->name, $racks)) {
            return '*Een stelling met deze naam bestaat al voor dit magazijn';
        }

        Rack::create(['name' => $rq->name, 'stockroom_id' => $id]);

        return redirect(route('stockrooms.details', $id));
    }

    public function create($id, Request $rq) {
        return view('stockrooms.partials.new-modal', [
            'id' => $id,
        ]);
    }

    public function closeCreate() {
        return '';
    }
}
