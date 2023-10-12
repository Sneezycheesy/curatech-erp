<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DesiredStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'curatech_product_id',
        'amount_initial',
        'amount_made',
        'amount_to_make',
        'start_date',
        'expiration_date',
    ];

    public function curatechProduct(): BelongsTo {
        return $this->belongsTo(CuratechProduct::class);
    }

    public function curatechComponents() {
        $curatech_product_id = $this->curatechProduct->id;
        return Component::whereHas('curatech_products', function($query) use($curatech_product_id) {
            $query->where('curatech_products_components.curatech_product_id', $curatech_product_id);
        })->paginate(50);
    }
}
