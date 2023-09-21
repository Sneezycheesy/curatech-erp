<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stockroom_id'
    ];

    public function stockroom() {
        return $this->hasOne(Stockroom::class);
    }

    public function shelves() {
        return $this->hasMany(Shelf::class);
    }
}
