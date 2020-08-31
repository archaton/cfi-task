<?php

declare(strict_types=1);

namespace Cfi\Domain\Repository;

use Cfi\Domain\Model\User;
use Cfi\Domain\ValueObject\IpAddress;
use Cfi\Domain\ValueObject\UserId;

interface UserRepository
{
    public function add(User $user): void;

    public function get(UserId $userId): User;

    public function getByIp(IpAddress $ipAddress): User;
}
