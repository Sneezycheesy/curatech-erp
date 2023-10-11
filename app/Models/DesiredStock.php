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
        'amount_initial',
        'amount_made',
        'amount_to_make',
        'start_date',
        'expiration_date',
    ];

    public function curatechProduct(): BelongsTo {
        return $this->belongsTo(CuratechProduct::class);
    }

    public function curatechComponents(): BelongsToMany {
        return $this->belongsToMany(Component::class, 'curatech_components_desired_stocks', 'desired_stock_id', 'curatech_component_id')
            ->distinct()->orderBy('curatech_component_id', 'ASC');
    }
}
