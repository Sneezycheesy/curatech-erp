<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'component_id',
        'description',
        'courant',
        'unit_price',
        'lt',
        'vpe',
        'feed',
        'c_number',
        'stock',
        'component_type',
        'component_value',
        'component_unit',
        'stock_machines',
        'smd',
        'feed',
    ];

    protected $casts = [
        'description' => 'string'
    ];

    public static function rules (bool $new = false) {
        return [
            'component_id' => $new ? 'unique:components|' : '' . 'required|max:10',
            'description' => 'required',
            'courant' => 'required',
            'unit_price' => 'required|numeric',
            'lt' => 'required|numeric',
            'stock' => 'required|numeric',
            'c_number' => 'required|numeric',
            'component_type' => 'required|max:255',
            'component_value' => 'required|numeric',
            'component_unit' => 'required|max:10',
        ];
    }

    public $min_unit_price;

    public function __constructor() {
        
    }

    public function stockValue() {
        return '€' . number_format($this->vendors()->orderBy('component_unit_price')->pluck('component_unit_price')->first() * $this->stock, 2, ',', '.');
    }

    public function priceRequiredStock($calculation = false) {
        $required_stock = $this->requiredStock();
        if (!$required_stock || $required_stock <= $this->stock + $this->stock_machines) {
            return 0;
        }

        $price = ($required_stock - $this->stock - $this->stock_machines) * $this->vendors()->orderBy('component_unit_price', 'ASC')->pluck('component_unit_price')->first();
        return $calculation ? $price : number_format($price, 2, ',', '.');
    }

    # Return the amount of components required to be able to produce the DESIRED
    # amount of Curatech Products that use this component
    public function requiredStock($desiredStock = null) {
        $stock_required = 0;

        $curatech_products = $this->desired_curatech_products;
        foreach($curatech_products as $curatech_product) {
            $stock_required += $curatech_product->activeDesiredStock->amount_to_make;
        }

        return $stock_required;
    }

    public function stockShortage() {
        if($this->stock + $this->stock_machines - $this->requiredStock() > 0) {
            return '';
        }

        return $this->requiredStock() - $this->stock - $this->stock_machines;
    }

    public function maxUnitPrice() {
        $min_price_array = $this->vendors()->pluck('component_unit_price')->toArray();
        if (!count($min_price_array)) {
            return '';
        }
        return '€' . max($min_price_array);
    }

    public function curatech_products(): BelongsToMany { 
        return $this->belongsToMany(CuratechProduct::class, 'curatech_products_components', 'component_id', 'curatech_product_id')
            ->with('activeDesiredStock');
    }

    public function desired_curatech_products(): BelongsToMany {
        return $this->curatech_products()->whereHas('activeDesiredStock');
    }

    public function manufacturers(): BelongsToMany {
        return $this->belongsToMany(Manufacturer::class, 'manufacturers_components', 'component_id', 'manufacturer_id');
    }

    public function vendors(): BelongsToMany {
        return $this->belongsToMany(Vendor::class, 'vendors_components', 'component_id', 'vendor_id')
        ->withPivot(['component_unit_price', 'vendor_product_nr'])
        ->orderBy('vendors_components.component_unit_price', 'ASC')
        ->orderBy('vendors.name', 'ASC');
    }

    public function restocks(): HasMany {
        return $this->hasMany(Restock::class);
    }

    public function shelves() {
        return $this->belongsToMany(Shelf::class, 'components_shelves', 'component_id', 'shelf_id');
    }

    public function ownWriteoffs() : HasMany {
        return $this->hasMany(WriteOff::class);
    }

    public function writeoffs() : belongsToMany {
        return $this->belongsToMany(WriteOff::class, 'components_write_offs', 'component_id', 'write_off_id')
            ->withPivot('new_stock')
            ->withPivot('amount');
    }

    public static function find($id) {
        return Component::where('component_id', $id)->first();
    }

    protected static function booted() {
        static::deleting(function(Component $comp) {
            $comp->vendors()->detach();
            $comp->curatech_products()->detach();
            $comp->shelves()->detach();
        });
    }
}
