<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WriteOff extends Model
{
    use HasFactory;

    protected $fillable = [
        'curatech_product_id',
        'component_id',
        'amount',
        'new_stock',
    ];

    public function curatech_product() : BelongsTo {
        return $this->belongsTo(CuratechProduct::class, 'curatech_product_id');
    }

    public function component() : BelongsTo {
        return $this->belongsTo(Component::class, 'component_id');
    }
}
