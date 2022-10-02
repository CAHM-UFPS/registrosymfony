<?php

namespace App\MessageHandler;

use App\Message\WelcomeMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class WelcomeMessageHandler implements MessageHandlerInterface
{
    public function __invoke(WelcomeMessage $message)
    {
        return $message->getMessage();
    }
}
