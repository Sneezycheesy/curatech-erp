<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CuratechProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'curatech_product_id',
        'name',
        'description',
        'stock',
        'stock_desired',
    ];

    public function get_components() {
        return components()->get();
    }

    public function components() {
        return $this->belongsToMany(Component::class, 'curatech_products_components', 'curatech_product_id', 'component_id')->withPivot('curatech_product_component_position');
    }

    public function writeoffs() {
        return $this->hasMany(WriteOff::class);
    }

    public static function find($id) {
        return CuratechProduct::where('curatech_product_id', $id)->first();
    }

    protected static function booted() {
        static::deleting(function (CuratechProduct $cp) {
            $cp->components()->detach();
        });
    }
}
