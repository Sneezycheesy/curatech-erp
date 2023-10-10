<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\DesiredStock;
use Illuminate\Http\Request;

use Mauritius\LaravelHtmx\Http\HtmxResponseClientRedirect;

class DesiredStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $desired_stocks = DesiredStock::where('expiration_date', '>=', now())
            ->with('curatechProduct')
            ->paginate(50);
        $curatech_components = Component::whereHas('desired_stocks')->with('vendors')->paginate(50);

        return view('desired_stocks.index', [
            'desired_stocks' => $desired_stocks,
            'curatech_components' => $curatech_components,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DesiredStock $desiredStock)
    {
        //
        return view('desired_stocks.details', [
            'desired_stock' => $desiredStock,
            'curatech_product' => $desiredStock->curatechProduct()->first(),
            'curatech_components' => $desiredStock->curatechComponents()->paginate(50),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DesiredStock $desiredStock)
    {
        //
        return view('desired_stocks.edit', [
            'desired_stock' => $desiredStock,
            'curatech_product' => $desiredStock->curatechProduct()->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DesiredStock $desiredStock)
    {
        //
        return view('desired_stocks.details', [
            'desired_stock' => $desiredStock,
            'curatech_product' => $desiredStock->curatechProduct()->first(),
            'curatech_components' => $desiredStock->curatechComponents()->paginate(50),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DesiredStock $desiredStock)
    {
        //
    }
}
