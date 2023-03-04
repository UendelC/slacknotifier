<?php

namespace App\Enums;

enum MailType: string
{
    case SPAM_NOTIFICATION = 'SpamNotification';
    case HARD_BOUNCE = 'HardBounce';

    public function isSpam(): bool
    {
        return $this === MailType::SPAM_NOTIFICATION;
    }
}
