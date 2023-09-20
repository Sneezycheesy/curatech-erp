<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restock;
use App\Models\Component;
use App\Models\CuratechProduct;

use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class RestockController extends Controller
{
    // Return view only with products and components linked to one another
    public function index (HtmxRequest $rq) {
        if ($rq->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('purchases'));
        }


        return view('purchases.index', [
            'curatech_products' => CuratechProduct::with('components')->whereHas('components')->orderBy('name', 'ASC')->get(),
            'components' => Component::with('curatech_products')
                ->whereHas('curatech_products')
                ->orderBy('component_id', 'ASC')
                ->get()
                ->filter(function($comp) {
                    return $comp->required_stock() > 0;
                })
        ]);
    }

    public function updateDesiredStock(HtmxRequest $request) {
        foreach ($request->except('_token') as $curatech_product_id=>$stock) {
            CuratechProduct::find(str_replace('_', '.', $curatech_product_id))->update(['stock_desired' => $stock ?? 0]);
        }

        return view('purchases.partials.components-table', [
            'components' => Component::with('curatech_products')
            ->whereHas('curatech_products')
            ->orderBy('component_id', 'ASC')
            ->get()
            ->filter(function($comp) {
                return $comp->required_stock() > 0;
            }),
        ]);
    }

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
