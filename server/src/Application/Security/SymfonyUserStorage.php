<?php

declare(strict_types=1);

namespace Cfi\Application\Security;

use Cfi\Application\Security\Exception\AccessDeniedException;
use Cfi\Domain\Model\User;
use Cfi\Domain\Repository\UserRepository;

class SymfonyUserStorage implements UserStorage
{
    private UserRepository $userRepository;
    private ?User $currentUser;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /** {@inheritdoc} */
    public function getUser(): User
    {
        if (null === $this->currentUser) {
            throw new AccessDeniedException("No user.");
        }

        return $this->currentUser;
    }

    /**
     * TODO too ugly
     */
    public function setCurrentUser(?User $user): void
    {
        $this->currentUser = $user;
    }
}
