<?php

declare(strict_types=1);

namespace Cfi\Application\Security;


use Cfi\Application\Security\Exception\AccessDeniedException;
use Cfi\Domain\Model\User;

interface UserStorage
{
    /**
     * @throws AccessDeniedException
     */
    public function getUser(): User;

}
