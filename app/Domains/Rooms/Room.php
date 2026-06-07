<?php

namespace App\Domains\Rooms;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'unit_id',
        'name',
    ];

    public function unit()
    {
        return $this->belongsTo(\App\Domains\Units\Unit::class);
    }

    public function assets()
    {
        return $this->hasMany(\App\Domains\Assets\Asset::class);
    }
}
