<?php

namespace App\Message;

class OrderMessage
{
    private string $email;
    private string $message;

    public function __construct(string $email, string $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): array
    {
        return $this->message;
    }
}