<?php

namespace App\Domains\Surveys;

use Illuminate\Database\Eloquent\Model;

class SurveyItem extends Model
{
    protected $fillable = [
        'survey_id',
        'asset_id',
        'condition',
        'existence',
        'notes',
        'photo',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function asset()
    {
        return $this->belongsTo(\App\Domains\Assets\Asset::class);
    }
}
