<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Vendor;
use App\Models\Component;

class VendorController extends Controller
{
    //
    public function index(Request $request) {
        $vendors = Vendor::all();

        if ($request->search) {
            $vendors = Vendor::where('name', 'like', "%$request->search%")
                ->orWhere('city', 'like', "%$request->search%")
                ->orWhere('zipcode', 'like', "%$request->search%")
                ->orWhere('zipcode', 'like', "%$request->search%")
                ->orWhere('country', 'like', "%$request->search%")
                ->get();
        }

        // Return vendors
        return view('vendors.index', [
            'vendors' => $vendors,
        ]);
    }

    public function details($id, Request $request) {
        return view('vendors.details', [
            'vendor' => Vendor::find($id),
            // 'comps' => Vendor::find($id)->components()->get(),
            'comps' => Vendor::find($id)->components()->get(),
        ]);
    }

    public function createPage(Request $rq) {
        return view('vendors.create');
    }

    public function edit($id, Request $request) {
        return view('vendors.edit', [
            'vendor' => Vendor::find($id),
        ]);
    }

    public function update($id, UpdateVendorRequest $request) {
        $request->validated();
        Vendor::find($id)->update($request->except('_token'));
        
        return redirect()->back()->with('success', 'Succesvol opgeslagen!');
    }

    public function create(StoreVendorRequest $request) {
        $request->validated();

        Vendor::create($request->except('_token'));

        return redirect()->back()->with('success', 'Leverancier ' . $request->name . ' aangemaakt');
    }

    public function delete($id, Request $request) {
        Vendor::find($id)->delete();

        return redirect(route('vendors'));
    }
}
