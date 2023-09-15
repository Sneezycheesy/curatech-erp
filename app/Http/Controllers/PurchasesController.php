<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuratechProduct;
use App\Models\Component;

class PurchasesController extends Controller
{
    // Return view only with products and components linked to one another
    public function get() {

        return view('components/purchases', [
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

    public function updateStock(Request $request) {
        foreach ($request->except('_token') as $curatech_product_id=>$stock) {
            CuratechProduct::findOrFail($curatech_product_id)->update(['stock_desired' => $stock]);
        }

        return redirect()->back();
    }
}
