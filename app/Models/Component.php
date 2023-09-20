<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    # Return the amount of components required to be able to produce the DESIRED
    # amount of Curatech Products that use this component
    public function required_stock() {
        $stock_required = 0;
        foreach ($this->curatech_products()->get() as $cp) {
           $stock_required += $cp->stock_desired;
        } 
        return $stock_required;
    }

    public function curatech_products(): BelongsToMany { 
        return $this->belongsToMany(CuratechProduct::class, 'curatech_products_components', 'component_id', 'curatech_product_id');
    }

    public function manufacturers(): BelongsToMany {
        return $this->belongsToMany(Manufacturer::class, 'manufacturers_components', 'component_id', 'manufacturer_id');
    }

    public function vendors(): BelongsToMany {
        return $this->belongsToMany(Vendor::class, 'vendors_components', 'component_id', 'vendor_id')->withPivot(['component_unit_price', 'vendor_product_nr']);
    }

    public function restocks(): HasMany {
        return $this->hasMany(Restock::class);
    }

    public static function find($id) {
        return Component::where('component_id', $id)->first();
    }
}
