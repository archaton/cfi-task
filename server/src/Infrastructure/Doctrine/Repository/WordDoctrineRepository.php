<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\Repository;


use Cfi\Domain\Model\Word;
use Cfi\Domain\Repository\WordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class WordDoctrineRepository implements WordRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Word::class);
    }
}
