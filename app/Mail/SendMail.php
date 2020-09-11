<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $name;
    public $header;

    /**
     * Create a new message instance.
     *
     * @param $content
     * @param $name
     * @param $header
     */
    public function __construct($content, $name, $header)
    {
        $this->content = $content;
        $this->name = $name;
        $this->header = $header;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $content = $this->content;

        return $this->subject($this->header)->markdown('emails.mail-notify', compact('content', 'name'));
    }
}
