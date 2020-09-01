<?php

declare(strict_types=1);

namespace Cfi\Domain\Model;

use Cfi\Domain\ValueObject\UserId;
use Cfi\Domain\ValueObject\WordId;

class Word
{
    private WordId $wordId;
    private UserId $userId;
    private string $word;
    private int $count;

    public function __construct(
        WordId $wordId,
        UserId $userId,
        string $word,
        int $count
    ) {
        $this->wordId = $wordId;
        $this->userId = $userId;
        $this->word = $word;
        $this->count = $count;
    }

    public function increaseCount(int $increaseAmount): void
    {
        $this->count += $increaseAmount;
    }
}
