<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuratechProduct;
use App\Models\Component;

use App\Http\Requests\UpdateCuratechProductRequest;

class CuratechProductController extends Controller
{
    //
    public function index() {
        return view('curatech_products.Index', [
            'curatech_products' => CuratechProduct::all(),
        ]);
    }

    public function details(string $id) {
        $curatech_product = CuratechProduct::find($id);
        return view('curatech_products.Details', [
            'curatech_product' => $curatech_product,
            'components' => $curatech_product->components()->get(),
        ]);
    }

    public function updatePage(string $id) {
        $curatech_product = CuratechProduct::find($id);
        $components = $curatech_product->components()->get();
        // Return only components that are NOT connected to $curatech_product
        $all_components = Component::all()->whereNotIn('id', $curatech_product->components()->pluck('curatech_products_components.component_id')->toArray());
        return view('curatech_products.Update', [
            'curatech_product' => $curatech_product,
            'components' => $components,
            'all_components' => $all_components,
        ]);
    }

    public function update(UpdateCuratechProductRequest $request) {
        $request->validated();

        $cp = CuratechProduct::find($request->route('id'));
        $cp->update($request->except('_token'));

        // If curatech_product_id was updated we need to reroute to the new details page
        // Always do this, regardsless of new id
        return redirect(route('curatech_product_update', $cp->curatech_product_id))->withSuccess('Product opgeslagen');
    }

    public function addComponent(Request $request) {
        $curatech_product = CuratechProduct::find($request->route('id'));
        $existing_components_ids = $curatech_product->components()->pluck('curatech_products_components.component_id')->toArray();
        if (!in_array($request->component_id, $existing_components_ids)){
            $curatech_product->components()->attach(Component::find($request->component_id)->id);
        }
        return redirect()->back();
    }

    public function removeComponent(Request $request) {
        $curatech_product = CuratechProduct::find($request->route('id'));
        $existing_components_ids = $curatech_product->components()->pluck('curatech_products_components.component_id')->toArray();
        if (in_array(Component::find($request->component_id)->id, $existing_components_ids)){
            $curatech_product->components()->detach(Component::find($request->component_id)->id);
        }
        return redirect()->back();
    }
}
