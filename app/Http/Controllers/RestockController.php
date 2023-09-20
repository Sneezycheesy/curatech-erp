<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restock;
use App\Models\Component;

use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class RestockController extends Controller
{
    //
    public function store(string $id, HtmxRequest $rq) {
        $component = Component::find($id);
        $component_id = $component->id;
        $vendor_id = $rq->vendor_id;
        $amount = $rq->amount;
        $invoice = $rq->invoice ?? '';

        Restock::create([
            'component_id' => $component_id,
            'vendor_id' => $vendor_id,
            'amount' => $amount,
            'invoice' => $invoice,
        ]);

        $component->update([
            'stock' => $component->stock + (int) $rq->amount,
        ]);

        return 'success';
    }
}
