<?php

declare(strict_types=1);

namespace Cfi\Domain\Model;

use Cfi\Domain\ValueObject\IpAddress;
use Cfi\Domain\ValueObject\UserId;

class User
{
    private UserId $userId;
    private IpAddress $ipAddress;

    public function __construct(UserId $userId, IpAddress $ipAddress)
    {
        $this->userId = $userId;
        $this->ipAddress = $ipAddress;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }
}
