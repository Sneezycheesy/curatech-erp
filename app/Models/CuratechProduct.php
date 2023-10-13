<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


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
        return $this->belongsToMany(Component::class, 'curatech_products_components', 'curatech_product_id', 'component_id')
            ->withPivot('curatech_product_component_position')
            ->orderby('components.component_id');
    }

    public function writeoffs() {
        return $this->hasMany(WriteOff::class);
    }

    public function activeDesiredStock(): HasOne {
        return $this->hasOne(DesiredStock::class)->where('start_date', '<=', now())
            ->where('expiration_date', '>=', now());
    }

    public function desiredStocks(): HasMany {
        return $this->hasMany(DesiredStock::class)
            ->orderBy('start_date', 'ASC');
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
