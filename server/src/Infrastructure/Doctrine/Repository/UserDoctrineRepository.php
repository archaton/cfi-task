<?php

declare(strict_types=1);

namespace Cfi\Infrastructure\Doctrine\Repository;


use Cfi\Domain\Exception\NotFoundException;
use Cfi\Domain\Model\User;
use Cfi\Domain\Repository\UserRepository;
use Cfi\Domain\ValueObject\IpAddress;
use Cfi\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserDoctrineRepository implements UserRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    /** {@inheritdoc} */
    public function get(UserId $userId): User
    {
        /** @var null|User $user */
        $user = $this->getRepository()->find($userId);
        if (null === $user) {
            throw new NotFoundException("User with id {$userId} not found.");
        }

        return $user;
    }

    /** {@inheritdoc} */
    public function getByIp(IpAddress $ipAddress): User
    {
        /** @var null|User $user */
        $user = $this->getRepository()->findOneBy(['ipAddress' => $ipAddress]);
        if (null === $user) {
            throw new NotFoundException("User with ip {$ipAddress} not found.");
        }

        return $user;
    }

    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(User::class);
    }
}
