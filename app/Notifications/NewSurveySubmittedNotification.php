<?php

namespace App\Notifications;

use App\Domains\Surveys\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSurveySubmittedNotification extends Notification
{
    use Queueable;

    protected $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Survey baru menunggu validasi dari unit ' . ($this->survey->unit->full_name ?? '-'),
            'url' => url('/admin/surveys?status=menunggu_validasi'),
            'survey_id' => $this->survey->id,
        ];
    }
}
