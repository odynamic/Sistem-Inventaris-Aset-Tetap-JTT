<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait RecordsActivity
{
    public function recordActivity($action, $module = null, $description = null)
    {
        ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => $action,
            'module'     => $module,
            'description'=> $description,
            'ip'         => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
