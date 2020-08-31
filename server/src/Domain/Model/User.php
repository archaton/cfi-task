<?php

declare(strict_types=1);

namespace Cfi\Domain\Model;

use Cfi\Domain\ValueObject\IpAddress;
use Cfi\Domain\ValueObject\UserId;

class User
{
    private $userId;
    private $ipAddress;

    public function __construct(UserId $userId, IpAddress $ipAddress)
    {
        $this->userId = $userId;
        $this->ipAddress = $ipAddress;
    }
}
