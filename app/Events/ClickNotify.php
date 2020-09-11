<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClickNotify
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $name;
    public $key;

    /**
     * Create a new event instance.
     *
     * @param $email
     * @param $key
     * @param $name
     */
    public function __construct($email, $key, $name)
    {
        $this->email = $email;
        $this->key = $key;
        $this->name = $name;
    }
}
