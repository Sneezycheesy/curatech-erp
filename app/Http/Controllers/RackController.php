<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

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
    public function details($id, HtmxRequest $rq) {
        if ($rq->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('racks.details', $id));
        }

        return view('racks.details', [
            'rack' => Rack::find($id),
        ]);
    }

    public function store($id, HtmxRequest $rq) {
        if (!isset($rq->name)) {
            return '*Verplicht veld';
        }

        $racks = Stockroom::find($id)->racks()->pluck('name')->toArray();
        if (in_array($rq->name, $racks)) {
            return '*Een stelling met deze naam bestaat al voor dit magazijn';
        }

        Rack::create(['name' => $rq->name, 'stockroom_id' => $id]);

        return new HtmxResponseClientRedirect(route('stockrooms.details', $id));
    }

    public function create($id, HtmxRequest $rq) {
        return view('stockrooms.partials.new-modal', [
            'id' => $id,
        ]);
    }

    public function closeCreate() {
        return '';
    }
}
