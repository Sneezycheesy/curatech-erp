<?php

namespace App\Http\Controllers;

use App\Models\WriteOff;
use App\Models\CuratechProduct;
use App\Models\Component;
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
        $components_to_update = [];
        if (is_numeric($request->amount)){
            $curatech_product = CuratechProduct::find($request->curatech_product_id);

            $writeoff = WriteOff::create([
                'curatech_product_id' => $curatech_product->id,
                'amount' => $request->amount,
            ]);

            /* #TODO: find a way to optimize these loops 
                Reduce the amount of loops needed to one if possible
                Updates to the database will NOT be correctly done in loops
                therefore we use 2 loops here, to update the stock on a component
                in one database query
            */
            foreach($curatech_product->components()->get() as $component) {
                if(array_key_exists($component->component_id, $components_to_update)) {
                    $components_to_update[$component->component_id] += 1;
                } else {
                    $components_to_update[$component->component_id] = 1;
                }
            }

            foreach($components_to_update as $key=>$value) {
                $component = Component::find($key);
                $component->update(['stock' => $component->stock - ($value * $request->amount)]);
                $component->writeoffs()->attach($writeoff, [
                    'new_stock' => $component->stock,
                    'amount' => $value * $request->amount,
                    'created_at' => now(),
                    'updated_at' => now()
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
