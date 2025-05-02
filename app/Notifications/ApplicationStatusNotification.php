<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    use Queueable;
    protected $jobTitle;
    protected $status;

    public function __construct($jobTitle, $status)
    {
        $this->jobTitle = $jobTitle;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your application for "' . $this->jobTitle . '" was ' . $this->status . '.',
        ];
    }
}
