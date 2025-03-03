<?php

declare(strict_types=1);

namespace Cfi\Application\Controller;

use Cfi\Application\Bus\CommandBus;
use Cfi\Application\Command\AddText\AddTextCommand;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddTextController
{
    private CommandBus $commandBus;
    private SerializerInterface $serializer;

    public function __construct(CommandBus $commandBus, SerializerInterface $serializer)
    {
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): void
    {//TODO move to param converter
        $data = array_merge(
            json_decode($request->getContent(), true),
            $request->attributes->all()
        );
        $command = $this->serializer->fromArray($data, AddTextCommand::class);

        $this->commandBus->handle($command);
    }
}
