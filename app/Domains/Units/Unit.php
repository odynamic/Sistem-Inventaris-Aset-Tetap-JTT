<?php

namespace App\Domains\Units;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'full_name',
    ];

    public function rooms()
    {
        return $this->hasMany(\App\Domains\Rooms\Room::class);
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
}
