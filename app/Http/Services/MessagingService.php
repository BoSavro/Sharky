<?php


namespace App\Http\Services;


use App\Mail\CommentNotificationMail;
use Illuminate\Support\Facades\Mail;

class MessagingService implements MessagingServiceInterface
{
    public function send($email, $data): void
    {
        Mail::to($email)->send(new CommentNotificationMail($data));
    }
}
