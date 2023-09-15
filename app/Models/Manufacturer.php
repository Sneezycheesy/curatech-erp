<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_name',
    ];

    public function components(): BelongsToMany {
        return $this->belongsToMany(Component::class, 'manufacturers_components', 'manufacturer_id', 'component_id');
    }
}
