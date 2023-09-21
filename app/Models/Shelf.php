<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rack_id',
    ];

    public function components() {
        return $this->belongsToMany(Components::class, 'components_shelves', 'shelf_id', 'component_id');
    }
}
