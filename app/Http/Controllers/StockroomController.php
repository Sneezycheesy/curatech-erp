<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stockroom;

use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class StockroomController extends Controller
{
    //
    public function index(HtmxRequest $rq) {
        if($rq->isHtmxRequest()) {
            return view('stockrooms.partials.index-stockrooms', [
                'stockrooms' => Stockroom::where('name', 'like', "%$rq->search%")
                    ->orWhere('location', 'like', "%$rq->search%")
                    ->get(),
            ]);
        }

        return view('stockrooms.index', [
            'stockrooms' => Stockroom::all(),
        ]);
    }

    public function create(HtmxRequest $rq) {
        if ($rq->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('stockrooms.create'));
        }

        return view('stockrooms.create');
    }

    public function store(HtmxRequest $rq) {
        $name = $rq->name;
        $location = $rq->location;
        $name_error = null;
        $location_error = null;
        
        if (count(Stockroom::where('name', $name)->get()) > 0) {
            $name_error = '*Deze naam is al in gebruik';
        }

        if (!isset($name)) {
            $name_error = '*Verplicht veld';
        }


        if (!isset($location)) {
            $location_error = '*Verplicht veld';
        }

        if (isset($name_error) || isset($location_error)) {

            return view('stockrooms.partials.create', [
                'name_error' => $name_error,
                'location_error' => $location_error,
                'name' => $name,
                'location' => $location,
            ]);
        }

        try {
            Stockroom::create($rq->except('_token'));
            return view('stockrooms.partials.create', [
                'success' => true,
            ]);
        }
        catch(Exception $e) {
            return 'Something went terribly wrong, share this error with a developer to tell them what you broke: ' . $e;
        }

    } 
}
