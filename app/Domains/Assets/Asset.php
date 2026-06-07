<?php

namespace App\Domains\Assets;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use SoftDeletes;

    protected $table = 'assets';
    protected $fillable = [
        'unit_id',
        'room_id',
        'code',
        'name',
        'quantity',
        'unit',
        'condition',
        'acquired_year',
    ];

    public function room()
    {
        return $this->belongsTo(\App\Domains\Rooms\Room::class);
    }

    public function unit()
    {
        return $this->belongsTo(\App\Domains\Units\Unit::class);
    }
}
