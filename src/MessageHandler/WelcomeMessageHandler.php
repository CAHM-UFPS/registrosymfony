<?php

namespace App\MessageHandler;

use App\Message\WelcomeMessage;
//use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class WelcomeMessageHandler implements MessageHandlerInterface
{
    //private LoggerInterface $logger;

    public function __invoke(WelcomeMessage $message)
    {
        $message->getMessage(); //Monolog genera falla
        //$this->logger->info($message->getMessage());
    }
}
