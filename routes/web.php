<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CuratechProductController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\StockroomController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\ShelfController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['curatech_devices' => App\Models\CuratechProduct::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Curatech Products
Route::get('/curatech_products', [CuratechProductController::class, 'index'])->middleware(['auth', 'verified'])->name('curatech_products');
Route::get('/curatech_product/{id}', [CuratechProductController::class, 'details'])->middleware(['auth', 'verified'])->name('curatech_product_details');
Route::get('/curatech_product/{id}/edit', [CuratechProductController::class, 'updatePage'])->middleware(['auth', 'verified'])->name('curatech_product_update');
Route::post('/curatech_product/{id}/edit', [CuratechProductController::class, 'update'])->middleware(['auth', 'verified'])->name('curatech_product_store');
Route::post('/curatech_product/{id}/add_component', [CuratechProductController::class, 'addComponent'])->middleware(['auth', 'verified'])->name('curatech_product_add_component');
Route::delete('/curatech_product/{id}/remove_component', [CuratechProductController::class, 'removeComponent'])->middleware(['auth', 'verified'])->name('curatech_product_remove_component');
Route::get('/curatech_products/create', [CuratechProductController::class, 'create'])->middleware(['auth', 'verified'])->name('curatech_products.create');
Route::post('/curatech_products/create', [CuratechProductController::class, 'createProduct'])->middleware(['auth', 'verified'])->name('curatech_products.create_product');

// Purchases
Route::get('/purchases', [RestockController::class, 'index'])->middleware(['auth', 'verified'])->name('purchases');
Route::put('/purchases', [CuratechProductController::class, 'writeOff'])->middleware(['auth', 'verified'])->name('purchases.writeoff');
Route::post('/purchases', [RestockController::class, 'updateDesiredStock'])->middleware(['auth', 'verified'])->name('purchases_update_stock');

// Stockrooms
Route::get('/stockrooms', [StockroomController::class, 'index'])->middleware(['auth', 'verified'])->name('stockrooms');
Route::get('/stockrooms/create', [StockroomController::class, 'create'])->middleware(['auth', 'verified'])->name('stockrooms.create');
Route::post('/stockrooms/create', [StockroomController::class, 'store'])->middleware(['auth', 'verified'])->name('stockrooms.store');
Route::get('/stockrooms/{id}', [StockroomController::class, 'details'])->middleware(['auth', 'verified'])->name('stockrooms.details');
Route::post('/stockrooms/{id}', [RackController::class, 'store'])->middleware(['auth', 'verified'])->name('racks.store');
Route::get('/stockrooms/rack/new/close', [RackController::class, 'closeCreate'])->middleware(['auth', 'verified'])->name('stockrooms.racks.new.close');

// Racks
Route::get('/racks/{id}', [RackController::class, 'details'])->middleware(['auth', 'verified'])->name('racks.details');
Route::post('/racks/{id}', [ShelfController::class, 'store'])->middleware(['auth', 'verified'])->name('planks.store');
Route::get('/racks/stockroom/{id}', [RackController::class, 'options'])->middleware(['auth', 'verified'])->name('racks.options');

Route::get('/shelves/rack/{id}', [ShelfController::class, 'options'])->middleware(['auth', 'verified'])->name('shelves.options');

// Components
Route::get('/components', [ComponentController::class, 'get'])->middleware(['auth', 'verified'])->name('components');
Route::post('/components/details/{id}/add_vendor', [ComponentController::class, 'addVendor'])->middleware(['auth', 'verified'])->name('components.vendor.add');
Route::get('/components/details/{id}', [ComponentController::class, 'details'])->middleware(['auth', 'verified'])->name('components.details');
Route::get('/components/edit/{id}', [ComponentController::class, 'editPage'])->middleware(['auth', 'verified'])->name('components.edit');
Route::post('/components/edit/{id}', [ComponentController::class, 'update'])->middleware(['auth', 'verified'])->name('components.update');
Route::delete('components/edit/{id}/vendor/{vendor_id}', [ComponentController::class, 'removeVendor'])->middleware(['auth', 'verified'])->name('components.removeVendor');
Route::post('/components/upload', [FileUploadController::class, 'uploadComponentsCSV'])->name('components_upload');
Route::get('/components/create', [ComponentController::class, 'createPage'])->name('components_create');
Route::post('/components/create', [ComponentController::class, 'create'])->name('components_create');
Route::post('components/{id}/add_shelf', [ComponentController::class, 'addShelf'])->middleware(['auth', 'verified'])->name('components.shelf.add');
Route::delete('/components/{id}/remove_shelf/{shelf_id}', [ComponentController::class, 'removeShelf'])->middleware(['auth', 'verified'])->name('components.shelf.remove');

// Restocking
Route::get('/components/{id}/restock', [ComponentController::class, 'restock'])->middleware(['auth', 'verified'])->name('components.restock');
Route::post('/components/{id}/restock', [RestockController::class, 'store'])->middleware(['auth', 'verified'])->name('restock');

// Vendors
Route::get('/vendors', [VendorController::class, 'index'])->middleware(['auth', 'verified'])->name('vendors');
Route::get('/vendors/create', [VendorController::class, 'createPage'])->middleware(['auth', 'verified'])->name('vendors.create');
Route::post('/vendors/create', [VendorController::class, 'create'])->middleware(['auth', 'verified'])->name('vendors.createVendor');
Route::get('/vendors/{id}', [VendorController::class, 'details'])->middleware(['auth', 'verified'])->name('vendors.details');
Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->middleware(['auth', 'verified'])->name('vendors.edit');
Route::post('/vendors/{id}/update', [VendorController::class, 'update'])->middleware(['auth', 'verified'])->name('vendors.update');
Route::delete('/vendors/{id}', [VendorController::class, 'delete'])->middleware(['auth', 'verified'])->name('vendors.delete');

// Authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
