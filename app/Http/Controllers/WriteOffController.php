<?php

namespace App\Http\Controllers;

use App\Models\WriteOff;
use App\Models\CuratechProduct;
use Illuminate\Http\Request;

use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class WriteOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_numeric($request->amount)){
            $curatech_product = CuratechProduct::find($request->curatech_product_id);

            $writeoff = WriteOff::create([
                'curatech_product_id' => $curatech_product->id,
                'amount' => $request->amount,
            ]);

            foreach($curatech_product->components()->get() as $component) {
                if ($request->amount > $component->stock) {
                    return "Kan geen negatieve voorraad aanmaken";
                }

                $component->update([
                    'stock' => $component->stock - $request->amount,
                ]);
                $component->writeoffs()->attach($writeoff->id, [
                    'new_stock' => $component->stock,
                ]);
            }
            return new HtmxResponseClientRedirect(route('purchases'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WriteOff $writeOff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WriteOff $writeOff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WriteOff $writeOff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WriteOff $writeOff)
    {
        //
    }
}
