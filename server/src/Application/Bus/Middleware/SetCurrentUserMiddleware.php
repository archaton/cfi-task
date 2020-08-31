<?php

declare(strict_types=1);

namespace Cfi\Application\Bus\Middleware;

use Cfi\Application\Security\UserStorage;
use Cfi\Domain\Exception\NotFoundException;
use Cfi\Domain\Model\User;
use Cfi\Domain\Repository\UserRepository;
use Cfi\Domain\UuidGenerator;
use Cfi\Domain\ValueObject\IpAddress;
use Cfi\Domain\ValueObject\UserId;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class SetCurrentUserMiddleware implements MiddlewareInterface
{
    private UserStorage $userStorage;
    private UserRepository $userRepository;
    private UuidGenerator $uuidGenerator;

    public function __construct(UserStorage $userStorage, UserRepository $userRepository, UuidGenerator $uuidGenerator)
    {
        $this->userStorage = $userStorage;
        $this->userRepository = $userRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $ip = new IpAddress($_SERVER['REMOTE_ADDR']);

        try {
            $user = $this->userRepository->getByIp($ip);
        } catch (NotFoundException $notFoundException) {
            // TODO maybe move user creation somewhere else?
            $user = new User(UserId::generate($this->uuidGenerator), $ip);
            $this->userRepository->add($user);
        }

        $this->userStorage->setCurrentUser($user);

        return $stack->next()->handle($envelope, $stack);
    }
}
