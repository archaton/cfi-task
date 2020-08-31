<?php

declare(strict_types=1);

namespace Cfi\Application;


use Cfi\Domain\UuidGenerator;
use Cfi\Domain\ValueObject\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

class Uuid4Generator implements UuidGenerator
{
    private $uuidFactory;

    public function __construct(UuidFactoryInterface $uuidFactory)
    {
        $this->uuidFactory = $uuidFactory;
    }

    public function generate(): Uuid
    {
        return new Uuid($this->uuidFactory->uuid4()->toString());
    }
}
