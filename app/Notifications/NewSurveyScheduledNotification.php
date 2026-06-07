<?php

namespace App\Notifications;

use App\Domains\Surveys\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSurveyScheduledNotification extends Notification
{
    use Queueable;

    public function __construct(public Survey $survey) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Jadwal Survey Baru',
            'message' => 'Survey untuk ruangan '.$this->survey->room->name.' telah dijadwalkan.',
            'url' => route('user.surveys.show', $this->survey->id),
        ];
    }
}
