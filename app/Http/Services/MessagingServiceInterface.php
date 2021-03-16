<?php


namespace App\Http\Services;


interface MessagingServiceInterface
{
    public function send(string $email, array $data);
}
