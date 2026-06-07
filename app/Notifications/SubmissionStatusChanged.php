<?php

namespace App\Notifications;

use App\Domains\Submissions\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubmissionStatusChanged extends Notification
{
    use Queueable;

    public function __construct(public Submission $submission) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => "Status Pengajuan Berubah",
            'message' => "Pengajuan #{$this->submission->id} sekarang {$this->submission->status}.",
            'url'     => route('user.submissions.show', $this->submission->id)
        ];
    }
}
