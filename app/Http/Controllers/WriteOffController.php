<?php

namespace App\Http\Controllers;

use App\Models\WriteOff;
use App\Models\CuratechProduct;
use App\Models\Component;
use Illuminate\Http\Request;

use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRefresh;

class WriteOffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $witeoffs = WriteOff::with('component')->with('curatech_product')->all();
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
        $error = null;
        if (!is_numeric($request->amount) || $request->amount < 0){
            return "Vul geldig getal in";
        }

        if(!is_integer(intval($request->amount))) {
            return "Vul een heel getal in";
        }

        if (isset($request->component_id)) {
            $component = Component::find($request->component_id);

            $component->update(['stock' => $component->stock - $request->amount]);
            WriteOff::create([
                'component_id' => $component->id,
                'amount' => $request->amount,
                'new_stock' => $component->stock,
            ]);
        }

        if(isset($request->curatech_product_id)) {
            $curatech_product = CuratechProduct::find($request->curatech_product_id);
            
            $components = $curatech_product->components()->pluck('components.component_id')->toArray();
            $components_to_update = array_count_values($components);
            
            /* #TODO: find a way to optimize these loops 
            Reduce the amount of loops needed to one if possible
            Updates to the database will NOT be correctly done in loops
                therefore we use 2 loops here, to update the stock on a component
                in one database query
            */
    
            foreach($components_to_update as $key=>$value) {
                $component = Component::find($key);
                if($component->stock - ($value * $request->amount) < 0) {
                    return 'Kan niet zoveel componenten afschrijven';
                }
            }
    
            $writeoff = WriteOff::create([
                'curatech_product_id' => $curatech_product->id,
                'amount' => $request->amount,
            ]);
    
            $curatech_product->update(['stock_desired' => $curatech_product->stock_desired - $request->amount]);
    
            $curatech_product->components()->get()->each(function ($comp) use ($request, $components_to_update, $writeoff) {
                $comp->update(['stock' => $comp->stock - ($components_to_update[$comp->component_id] * $request->amount)]);
                $comp->writeoffs()->attach($writeoff, [
                    'new_stock' => $comp->stock,
                    'amount' => $components_to_update[$comp->component_id] * $request->amount,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            });
        }

        return new HtmxResponseClientRefresh();
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
