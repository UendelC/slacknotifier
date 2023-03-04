<?php

namespace App\Http\Controllers;

use App\Enums\MailType;
use App\Http\Requests\StoreMailRequest;
use App\Models\User;
use App\Notifications\SlackSpamNotification;

class MailController extends Controller
{
    public function store(StoreMailRequest $request)
    {
        if (MailType::from($request->Type)->isSpam()) {
            User::first() // CurrentUser::instance();
                ->notify(new SlackSpamNotification($request->Email));
        }
    }
}
