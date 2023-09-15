<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'zipcode',
        'city',
        'country',
    ];

    public function components(): BelongsToMany {
        return $this->belongsToMany(Component::class, 'vendors_components', 'vendor_id', 'component_id');
    }
}
