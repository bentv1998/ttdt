<?php

namespace App\Listeners;

use App\Events\ClickNotify;
use App\Mail\NotifyUse;
use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class SendEmailUsePretaNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClickNotify  $event
     * @return void
     */
    public function handle(ClickNotify $event)
    {

        $email = $event->email;
        $key = $event->key;
        $name = $event->name;

        $mail = \App\Models\Mail::where('key', $event->key)->first();
        $content = $mail->body ?? '';
        $header = $mail->header ?? '';

        if (!$email || !$content) {
            return;
        }

       Mail::to($email)->send(new SendMail($content, $name, $header));
    }
}
