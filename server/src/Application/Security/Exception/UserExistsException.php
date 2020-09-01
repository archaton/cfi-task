<?php

declare(strict_types=1);

namespace Cfi\Application\Security\Exception;

class UserExistsException extends \RuntimeException
{
    private string $userId;

    public function __construct(string $userId)
    {
        parent::__construct('User already registered with a different id.');
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
