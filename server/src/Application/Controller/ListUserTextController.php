<?php

declare(strict_types=1);

namespace Cfi\Application\Controller;


use Cfi\Application\Bus\QueryBus;
use Cfi\Application\Query\ListTextRank\ListTextRankQuery;
use JMS\Serializer\ArrayTransformerInterface;
use Symfony\Component\HttpFoundation\Request;

class ListUserTextController
{
    private QueryBus $queryBus;
    private ArrayTransformerInterface $serializer;

    public function __construct(QueryBus $queryBus, ArrayTransformerInterface $serializer)
    {
        $this->queryBus = $queryBus;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): QueryBus\ApiPresenter
    {//TODO move to param converter
        $query = $this->serializer->fromArray($request->attributes->all(), ListTextRankQuery::class);

        return $this->queryBus->handle($query);
    }
}
