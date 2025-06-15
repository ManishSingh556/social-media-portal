<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FriendRequestMail extends Mailable
{
    use Queueable, SerializesModels;

   public $sender;

    public function __construct($sender)
    {
        $this->sender = $sender;
    }

    public function build()
    {
        return $this->subject('You received a friend request!')
                    ->markdown('emails.friend_request')
                    ->with('sender', $this->sender);
    }
}
