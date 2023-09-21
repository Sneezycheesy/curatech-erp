<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stockroom;

use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class StockroomController extends Controller
{
    //
    public function index() {
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
        return '';
    } 
}
