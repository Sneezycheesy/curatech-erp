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

    ];

    public function curatechProduct(): BelongsTo {
        return $this->belongsTo(CuratechProduct::class);
    }

    public function curatechComponents(): BelongsToMany {
        return $this->belongsToMany(Component::class, 'curatech_components_desired_stocks', 'desired_stock_id', 'curatech_product_id');
    }
}
