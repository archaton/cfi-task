<?php

declare(strict_types=1);

namespace Cfi\Domain\ValueObject;

class IpAddress
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $otherIp): bool
    {
        return $this->value === $otherIp->value;
    }
}
