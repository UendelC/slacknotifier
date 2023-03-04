<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Notifications\SlackSpamNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class MailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItNotifiesSlackWithSpamMail(): void
    {
        Notification::fake();

        User::factory()->create();

        $payload = [
            'RecordType' => 'Bounce',
            'Type' => 'SpamNotification',
            'TypeCode' => 512,
            'Name' => 'Spam notification',
            'Tag' => '',
            'MessageStream' => 'outbound',
            'Description' => 'The message was delivered, but was either blocked by the user, or classified as spam, bulk mail, or had rejected content.',
            'Email' => 'zaphod@example.com',
            'From' => 'notifications@honeybadger.io',
            'BouncedAt' => '2023-02-27T21:41:30Z',
        ];

        $this->postJson(route('mails.store'), $payload)
            ->assertOk();

        Notification::assertSentTo(
            User::first(),
            SlackSpamNotification::class
        );
    }

    public function testItDoesNotNotifySlackWithNonSpamMail(): void
    {
        Notification::fake();

        User::factory()->create();

        $payload = [
            'RecordType' => 'Bounce',
            'Type' => 'HardBounce',
            'TypeCode' => 1,
            'Name' => 'Hard bounce',
            'Tag' => '',
            'MessageStream' => 'outbound',
            'Description' => 'The message was not delivered due to a permanent error.',
            'Email' => 'zaphod@example.com',
            'From' => 'notifications@honeybadger.io',
            'BouncedAt' => '2023-02-27T21:41:30Z',
        ];

        $this->postJson(route('mails.store'), $payload)
            ->assertOk();

        Notification::assertNothingSent();
    }
}
