<?php

declare(strict_types=1);

namespace Cfi\Application\Controller;

use Cfi\Application\Bus\CommandBus;
use Cfi\Application\Command\CreateUser\CreateUserCommand;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateUserController
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
        $command = $this->serializer->deserialize($request->getContent(), CreateUserCommand::class, 'json');

        $this->commandBus->handle($command);
    }

}
