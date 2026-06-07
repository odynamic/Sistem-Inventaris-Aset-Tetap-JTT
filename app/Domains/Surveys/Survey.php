<?php

namespace App\Domains\Surveys;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'unit_id',
        'room_id',
        'scheduled_date',
        'survey_method',
        'status',
        'performed_by',
    ];

    public function unit()
    {
        return $this->belongsTo(\App\Domains\Units\Unit::class);
    }

    public function room()
    {
        return $this->belongsTo(\App\Domains\Rooms\Room::class);
    }

    public function performer()
    {
        return $this->belongsTo(\App\Models\User::class, 'performed_by');
    }

    public function items()
    {
        return $this->hasMany(\App\Domains\Surveys\SurveyItem::class);
    }
}
