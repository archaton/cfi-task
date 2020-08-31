<?php

declare(strict_types=1);

namespace Cfi\Domain\Model;


use Cfi\Domain\ValueObject\UserId;
use Cfi\Domain\ValueObject\WordId;

class Word
{
    private $wordId;
    private $userId;
    private $word;
    private $count;

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
}
