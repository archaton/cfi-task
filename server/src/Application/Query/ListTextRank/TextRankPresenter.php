<?php

declare(strict_types=1);

namespace Cfi\Application\Query\ListTextRank;

class TextRankPresenter
{
    private string $word;
    private int $count;

    public function __construct(
        string $word,
        int $count
    ) {
        $this->word = $word;
        $this->count = $count;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
