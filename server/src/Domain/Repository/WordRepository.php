<?php

declare(strict_types=1);

namespace Cfi\Domain\Repository;

use Cfi\Domain\Model\Word;
use Cfi\Domain\ValueObject\UserId;

interface WordRepository
{
    public function getByWordAndUser(string $word, UserId $userId): Word;
}
