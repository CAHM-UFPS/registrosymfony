<?php

namespace App\Message;

class WelcomeMessage
{
    private string $message;
    private string $email;

    public function __construct(string $email, string $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}