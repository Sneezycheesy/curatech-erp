<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Vendor;
use App\Models\Component;

class VendorController extends Controller
{
    //
    public function index(HtmxRequest $request) {
        if ($request->isHtmxRequest()) {
            return view('vendors.partials.Vendors', [
                'vendors' => Vendor::where('name', 'like', "%$request->search%")
                    ->orWhere('city', 'like', "%$request->search%")
                    ->orWhere('address', 'like', "%$request->search%")
                    ->orWhere('country', 'like', "%$request->search%")
                    ->get()
            ]);
        }

        // Return all vendors
        return view('vendors.Index', [
            'vendors' => Vendor::all(),
        ]);
    }

    public function details($id, HtmxRequest $request) {
        // Return a redirect when requested through htmx
        if ($request->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('vendors.details', $id));
        }

        return view('vendors.Details', [
            'vendor' => Vendor::find($id),
            // 'comps' => Vendor::find($id)->components()->get(),
            'comps' => Vendor::find($id)->components()->get(),
        ]);
    }

    public function createPage(HtmxRequest $rq) {
        if($rq->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('vendors.create'));
        }
        return view('vendors.Create');
    }

    public function edit($id, HtmxRequest $request) {
        if ($request->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('vendors.edit', $id));
        }

        return view('vendors.Edit', [
            'vendor' => Vendor::find($id),
        ]);
    }

    public function update($id, UpdateVendorRequest $request) {
        Vendor::find($id)->update($request->except('_token'));
        
        return redirect()->back()->with('success', 'Succesvol opgeslagen!');
    }

    public function create(StoreVendorRequest $request) {
        $request->validated();

        Vendor::create($request->except('_token'));

        return redirect()->back()->with('success', 'Leverancier ' . $request->name . ' aangemaakt');
    }

    public function delete($id, HtmxRequest $request) {
        Vendor::find($id)->delete();

        return new HtmxResponseClientRedirect(route('vendors'));
    }
}
