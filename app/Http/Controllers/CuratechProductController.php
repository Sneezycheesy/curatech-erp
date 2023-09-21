<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuratechProduct;
use App\Models\Component;

use Mauricius\LaravelHtmx\Http\HtmxResponseClientRedirect;
use Mauricius\LaravelHtmx\Http\HtmxRequest;

use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\UpdateCuratechProductRequest;
use App\Http\Requests\StoreCuratechProductRequest;
use App\Http\Requests\AddComponentToCuratechProductRequest;

class CuratechProductController extends Controller
{
    //
    public function index(HtmxRequest $rq) {
        if ($rq->isHtmxRequest()) {
            return view('curatech_products.partials.curatech_products', [
                'curatech_products' => CuratechProduct::where('curatech_product_id', 'like', "%$rq->search%")
                    ->orWhere('name', 'like', "%$rq->search%")
                    ->orWhere('description', 'like', "%$rq->search%")
                    ->get(),
            ]);
        }

        return view('curatech_products.index', [
            'curatech_products' => CuratechProduct::all(),
        ]);
    }

    public function details(string $id, HtmxRequest $request) {
        if($request->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('curatech_product_details', $id));
        }

        $curatech_product = CuratechProduct::find($id);
        return view('curatech_products.details', [
            'curatech_product' => $curatech_product,
            'components' => $curatech_product->components()->get(),
        ]);
    }

    public function updatePage(string $id, HtmxRequest $request) {
        if($request->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('curatech_product_update', $id));
        }

        $curatech_product = CuratechProduct::find($id);
        $components = $curatech_product->components()->get();
        // Return only components that are NOT connected to $curatech_product
        $all_components = Component::all();
        return view('curatech_products.update', [
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

    public function addComponent(AddComponentToCuratechProductRequest $request) {
        $comp = CuratechProduct::find($request->route('id'))->components()->wherePivot('curatech_product_component_position', strtoupper($request->curatech_product_component_position))->get();
        
        if(count($comp) > 0) {
            throw ValidationException::withMessages(['curatech_product_component_position' => 'Positie is al bezet']);
        }

        $request->validated();

        $curatech_product = CuratechProduct::find($request->route('id'));
        $existing_components_ids = $curatech_product->components()->pluck('curatech_products_components.component_id')->toArray();
        if (!in_array($request->component_id, $existing_components_ids)){
            $curatech_product->components()->attach(Component::find($request->component_id)->id, [
                'curatech_product_component_position' => strtoupper($request->curatech_product_component_position)
            ]);
        }
        return redirect()->back();
    }

    public function removeComponent(HtmxRequest $request) {
        $curatech_product = CuratechProduct::find($request->route('id'));
        $curatech_product->components()->wherePivot('curatech_product_component_position', $request->curatech_product_component_position)->detach();
        
        return view('curatech_products.partials.components', [
            'components' => CuratechProduct::find($request->route('id'))->components()->get(),
            'curatech_product' => $curatech_product,
        ]);
    }

    public function create(HtmxRequest $rq) {
        if($rq->isHtmxRequest()) {
            return new HtmxResponseClientRedirect(route('curatech_products.create'));
        }

        return view('curatech_products.create', [
            'components' => [],
            'all_components' => Component::all()
        ]);
    }

    public function createProduct(StoreCuratechProductRequest $request) {
        CuratechProduct::create($request->validated());
        return redirect()->back()->with('success', 'Product aangemaakt');
    }
}
