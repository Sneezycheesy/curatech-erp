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
        return $this->belongsToMany(Component::class, 'components_shelves', 'shelf_id', 'component_id');
    }

    protected static function booted() {
        static::deleting(function ($shelf) {
            $shelf->components()->detach();
        });
    }
}
