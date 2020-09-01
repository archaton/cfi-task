<?php

declare(strict_types=1);

namespace Cfi\Application\Query\ListTextRank;


interface ListTextRankQueryHandler
{
    public function __invoke(ListTextRankQuery $query): ListTextRankPresenter;
}
