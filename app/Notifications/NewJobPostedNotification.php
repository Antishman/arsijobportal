<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Job;

class NewJobPostedNotification extends Notification
{
    use Queueable;
    
    public $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New job posted: "' . $this->job->title . '" at ' . $this->job->location,
        ];
    }
}
