<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\Repository;

use Cfi\Domain\Exception\NotFoundException;
use Cfi\Domain\Model\Word;
use Cfi\Domain\Repository\WordRepository;
use Cfi\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class WordDoctrineRepository implements WordRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Word $word): void
    {
        $this->entityManager->persist($word);
    }

    /** {@inheritdoc} */
    public function getByWordAndUser(string $word, UserId $userId): Word
    {
        /** @var null|Word $word */
        $word = $this->getRepository()->findOneBy(['word' => $word, 'userId' => $userId]);
        if (null === $word) {
            throw new NotFoundException('Word not found.');
        }

        return $word;
    }

    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(Word::class);
    }
}
