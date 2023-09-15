<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    use HasFactory;

    protected $fillables = [
        'id',
        'component_id',
        'amount_restock'
    ];

    public function component() {
        return $this->hasOne(Component::class, 'component_id');
    }
}
