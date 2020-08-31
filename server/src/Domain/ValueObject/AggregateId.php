<?php

declare(strict_types=1);

namespace Cfi\Domain\ValueObject;

use Cfi\Domain\UuidGenerator;

abstract class AggregateId
{
    protected $uuid;

    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public function __toString(): string
    {
        return (string) $this->uuid;
    }

    public static function createFromString(string $value)
    {
        $uuid = new Uuid($value);

        return new static($uuid);
    }

    /**
     * @return static
     */
    public static function generate(UuidGenerator $generator): self
    {
        $uuid = $generator->generate();

        return new static($uuid);
    }

    public function equals(self $aggregateId): bool
    {
        return $this->uuid->equals($aggregateId->uuid);
    }
}
