<?php

namespace App\Http\Controllers;

use Mauricius\LaravelHtmx\Http\HtmxRequest;
use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;

use App\Http\Requests\UpdateComponentRequest;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\ConnectVendorToComponentRequest;
use App\Models\Component;
use App\Models\Vendor;

class ComponentController extends Controller
{
    public function get(HtmxRequest $request) {
        $search = '';
        $comps = [];

        if($request->isHtmxRequest()) {
            return view('curatech_components.partials.components', [
                'components' => Component::where('component_id', 'like', "%$request->search%")
                ->orWhere('description', 'like', "%$request->search%")
                ->get()
            ]);
        }

        if (!empty($request->query()['search'])) {
            $search = $request->query()['search'];
            $comps = Component::where('component_id', 'like', "%$search%")
                        ->orWhere('description', 'like', $search)
                        ->get();
        }

        return view('curatech_components.Index', [
            'components' => empty($comps) ? Component::all() : $comps,
            'search' => $search,
        ]);
    }

    // Request to the edit page for a specific component
    // Edit page displays a form to enter how much new stock there is and which vendor is was purchased from
    public function editPage($id, HtmxRequest $rq) {
        if ($rq->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('components.edit', $id));
        }

        return view('curatech_components.Edit', [
            'comp' => Component::where('component_id', $id)->First(),
            'vendors' => Component::find($id)->vendors()->withPivot('component_unit_price')->get(),
            'all_vendors' => Vendor::all()->whereNotIn('id', Component::find($id)->vendors()->pluck('vendors_components.vendor_id')->toArray()),
        ]);
    }

    // API call to update component data in the database
    // Add a new Restock item to the restocks table to keep a history of when stock was bought
    public function update($id, UpdateComponentRequest $request) {
        $request->validated();

        $comp = $request->except('_token');
        $comp['courant'] = $comp['courant'] == 'Y' ? 1 : 0;
        Component::find($id)->update($comp);

        return redirect()->back()->with('success', 'Component succesvol opgeslagen!');
    }

    public function details($id) {
        return view('curatech_components.Details', [
            'comp' => Component::find($id),
            'vendors' => Component::find($id)->vendors()->withPivot('component_unit_price')->get(),
            'all_vendors' => Vendor::all()->whereNotIn('id', Component::find($id)->vendors()->pluck('vendors_components.vendor_id')->toArray()),
        ]);
    }

    public function createPage(HtmxRequest $request) {

        return $request->isHtmxRequest() ? new HtmxResponseClientRedirect(route('components_create')) : view('curatech_components.Create');
    }

    public function create(StoreComponentRequest $request) {
        $valid = $request->validated();

        if ($valid) {
            $valid['courant'] = $valid['courant'] == 'Y' ? 1 : 0;
            Component::create($valid);
        }

        // TODO: Add suppliers based on name
        // Also add the price of the component for each supplier
        // Create a new supplier when name is unique
        // Create link to existing suppier when name is exists

        return redirect()->back();
    }

    public function addVendor($id, ConnectVendorToComponentRequest $request) {
        $request->validated();

        Component::find($id)->vendors()->attach($request->vendor_id, [
            'vendor_product_nr' => $request->vendor_product_nr,
            'component_unit_price' => $request->component_unit_price,
        ]);

        return redirect()->back();
    }

    public function removeVendor($id, HtmxRequest $rq) {
        try {
            Component::find($id)->vendors()->detach($rq->except('_token'));
            return new HtmxResponseClientRedirect(route('components.edit', $id));
        } catch (Exeption $e) {
            return redirect()->back()->with(['error' => $e]);
        }
    }
}



