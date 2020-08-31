<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\DBAL\Type;

use Cfi\Domain\ValueObject\UserId;

class UserIdType extends UuidType
{
    public function getName(): string
    {
        return 'userId';
    }

    protected function getClassName(): string
    {
        return UserId::class;
    }
}
