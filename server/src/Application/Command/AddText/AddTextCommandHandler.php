<?php

declare(strict_types=1);

namespace Cfi\Application\Command\AddText;

use Cfi\Application\Security\UserStorage;
use Cfi\Domain\Repository\WordRepository;

class AddTextCommandHandler
{
    private UserStorage $userStorage;
    private WordRepository $wordRepository;

    public function __construct(UserStorage $userStorage, WordRepository $wordRepository)
    {
        $this->userStorage = $userStorage;
        $this->wordRepository = $wordRepository;
    }

    public function __invoke(AddTextCommand $command): void
    {
        $user = $this->userStorage->getUser();

//        TODO
    }
}
