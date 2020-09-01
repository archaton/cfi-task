<?php

declare(strict_types=1);

namespace Cfi\Application\Command\CreateUser;


use Cfi\Application\Security\Exception\UserExistsException;
use Cfi\Domain\Exception\NotFoundException;
use Cfi\Domain\Model\User;
use Cfi\Domain\Repository\UserRepository;
use Cfi\Domain\ValueObject\IpAddress;
use Cfi\Domain\ValueObject\UserId;

class CreateUserCommandHandler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $ip = new IpAddress($_SERVER['REMOTE_ADDR']);

        try {
            $user = $this->userRepository->getByIp($ip);

            throw new UserExistsException((string) $user->getUserId());
        } catch (NotFoundException $notFoundException) {
            $user = new User(UserId::createFromString($command->getUserId()), $ip);
            $this->userRepository->add($user);
        }
    }
}
