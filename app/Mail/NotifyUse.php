<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyUse extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $name;

    /**
     * Create a new message instance.
     *
     * @param $content
     * @param $name
     */
    public function __construct($content, $name)
    {
        $this->content = $content;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = $this->content;
        $name = $this->name;
        return $this->from(config('app.email'))->markdown('emails.notify.notify', $content);
    }
}
