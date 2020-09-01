<?php

declare(strict_types=1);

namespace Cfi\Application\Query\ListTextRank;

use Cfi\Application\Bus\QueryBus\ApiPresenter;

class ListTextRankPresenter implements ApiPresenter
{
    /** @var array|TextRankPresenter[] */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return array|TextRankPresenter[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
