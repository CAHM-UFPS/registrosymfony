<?php

namespace App\MessageHandler;

use App\Message\OrderMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Contracts\Service\Attribute\Required;

class OrderMessageHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    #[Required]
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function __invoke(OrderMessage $message)
    {
        $this->logger->info("User: ".$message->getEmail()." : ".$message->getMessage());
    }
}