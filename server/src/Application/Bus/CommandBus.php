<?php

declare(strict_types=1);

namespace Cfi\Application\Bus;

use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function handle(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}
