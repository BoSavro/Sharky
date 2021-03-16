<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public $data
    ) { }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'New comment added';
        $address = 'info@sharky.com';
        $name    = 'Administration';

        return $this->view('emails.test')
            ->from($address, $name)
            ->subject($subject);
    }
}
