<?php

declare(strict_types=1);

namespace Cfi\Domain;

use Cfi\Domain\ValueObject\Uuid;

interface UuidGenerator
{
    public function generate(): Uuid;
}
