<?php

declare(strict_types=1);

namespace Cfi\Domain\ValueObject;

class Uuid
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

    public function equals(self $uuid): bool
    {
        return $this->value === $uuid->value;
    }
}
