<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\Query;

use Cfi\Application\Query\ListTextRank\ListTextRankPresenter;
use Cfi\Application\Query\ListTextRank\ListTextRankQuery;
use Cfi\Application\Query\ListTextRank\ListTextRankQueryHandler;
use Cfi\Application\Query\ListTextRank\TextRankPresenter;
use Doctrine\DBAL\Connection;

class ListTextRankDoctrineQueryHandler implements ListTextRankQueryHandler
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(ListTextRankQuery $query): ListTextRankPresenter
    {
        $qb = $this->connection->createQueryBuilder();
        $qb->select(['w.word', 'w.count']);
        $qb->from('cfi.words', 'w');
        $qb->where('w.user_id = :userId');
        $qb->setParameter('userId', $query->getUserId());
        $qb->addOrderBy('w.count', 'DESC');
        $qb->addOrderBy('w.word', 'ASC');

        $statement = $qb->execute();
        $result = $statement->fetchAll();
        $items = [];
        foreach ($result as $row) {
            $items[] = new TextRankPresenter(
                $row['word'],
                $row['count']
            );
        }

        return new ListTextRankPresenter($items);
    }
}
