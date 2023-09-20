<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    use HasFactory;

    protected $fillables = [
        'component_id',
        'amount',
        'vendor_id',
        'invoice'
    ];

    public function component() {
        return $this->hasOne(Component::class, 'component_id');
    }

    public function vendor() {
        return $this->hasOne(Vendor::class, 'vendor_id');
    }
}
