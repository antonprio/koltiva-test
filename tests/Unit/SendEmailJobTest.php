<?php

namespace Tests\Unit;

use App\Jobs\SendEmailJob;
use App\Mail\EmailConfirmation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_email()
    {
        Mail::fake();

        $user = User::factory()->create();

        $job = new SendEmailJob($user);
        $job->handle();

        Mail::assertSent(EmailConfirmation::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email) && $mail->user->is($user);
        });
    }
}
