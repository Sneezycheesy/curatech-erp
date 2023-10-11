<?php

namespace App\Http\Controllers;

use App\Models\WriteOff;
use App\Models\CuratechProduct;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function storeForCuratechProduct(Request $request) {
        $validator = Validator::make($request->all(), [
            'curatech_product_id' => 'required|exists:curatech_products',
            'amount' => 'required|integer',
            'production_step' => 'required|in:SMD,ASSEMBLY',
        ]);
        
        if($validator->fails()) {
            dd ($validator->errors());
        }

        $smd = $request->production_step == 'SMD' ? true : false;
        

        $curatech_product = CuratechProduct::find($request->curatech_product_id);

        $components = $curatech_product->components()->where('smd', $smd)->orderBy(!$smd ? 'stock' : 'stock_machines', 'ASC')->pluck('components.component_id')->toArray();
        $components_to_update = array_count_values($components);


        foreach($components_to_update as $comp=>$amount) {
            $component = Component::find($comp);
            $max_amount = ($smd ? $component->stock_machines : $component->stock) / $amount;
            $validator = Validator::make($request->all(), [
                'amount' => 'integer|max:' . $max_amount,
            ], 
            [
                'amount.max' => "Kan maximaal :max producten afboeken",
            ]);

            if ($validator->fails()) {
                return $validator->errors();
            }
        }
        $writeoff = WriteOff::create([
            'curatech_product_id' => $curatech_product->id,
            'amount' => $request->amount,
        ]);

        $desired_stock = $curatech_product->desiredStocks()->where('start_date', '<=', now())->where('expiration_date', '>=', now())->first();
        $desired_stock->update([
            'amount_made' => $desired_stock->amount_made + $request->amount,
            'amount_to_make' => $desired_stock->amount_to_make - $request->amount > 0 ? $desired_stock->amount_to_make - $request->amount : 0,
        ]);

        $desired_stock->curatechComponents()->where('smd', $smd)->get()->each(function ($comp) use ($request, $components_to_update) {
            $comp->update(['amount_made' => $comp->amount_made + $request->amount * $components_to_update[$comp->component_id],
                            'amount_to_make' => $comp->amount_to_make - $request->amount * $components_to_update[$comp->component_id] > 0 ? $comp->amount_to_make - $request->amount * $components_to_update[$comp->component_id] : 0,
            ]);
        });

        $components = $curatech_product->components()->where('smd', $smd)->orderBy(!$smd ? 'stock' : 'stock_machines', 'ASC')->get();
        $components->each(function ($comp) use ($request, $components_to_update, $smd) {
            if (!$smd) {
                $comp->update(['stock' => $comp->stock - ($request->amount * $components_to_update[$comp->component_id])]);
            } else {
                $comp->update(['stock_machines' => $comp->stock_machines - ($request->amount * $components_to_update[$comp->component_id])]);
            }
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'component_id' => 'required|integer',
            'amount' => 'required|numeric|integer',
        ]);

        if ($validator->fails()) {
            return '';
        }

        if (isset($request->component_id)) {
            $component = Component::find($request->component_id);
            $new_stock;

            if($request->stock_from == 'STOCKROOM') {
                $component->update(['stock' => $component->stock - $request->amount]);
                $new_stock = $component->stock;
            } else if ($request->stock_from == 'MACHINE') {
                $component->update(['stock_machines' => $component->stock_machines - $request->amount]);
                $new_stock = $component->stock_machines;
            }

            WriteOff::create([
                'component_id' => $component->id,
                'amount' => $request->amount,
                'new_stock' => $new_stock,
                'stock_from' => $request->stock_from,
            ]);
        }

        if(isset($request->curatech_product_id)) {
            $curatech_product = CuratechProduct::find($request->curatech_product_id);

            if($request->amount > $curatech_product->stock_desired) {
                return 'Kan niet meer componenten afschrijven dan gewenst';
            }
            
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
                    'updated_at' => now(),
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
