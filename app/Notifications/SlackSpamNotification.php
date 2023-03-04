<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SlackSpamNotification extends Notification
{
    use Queueable;

    public function __construct(public string $email)
    {
    }

    public function via(User $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(User $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->content('This is a spam notification from email: ' . $this->email);
    }
}
