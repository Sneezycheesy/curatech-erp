<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WriteOff extends Model
{
    use HasFactory;

    protected $fillable = [
        'curatech_product_id',
        'component_id',
        'amount',
        'new_stock',
        'stock_from',
        'created_at',
        'updated_at',
    ];

    public function curatech_product() : BelongsTo {
        return $this->belongsTo(CuratechProduct::class, 'curatech_product_id');
    }

    public function component() : BelongsTo {
        return $this->belongsTo(Component::class, 'component_id');
    }

    public function components() : BelongsToMany {
        return $this->belongsToMany(Component::class, 'components_write_offs', 'write_off_id', 'component_id');
    }
}
