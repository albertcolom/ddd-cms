<?php

namespace App\Infrastructure\Domain\User\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\ValueObject\UserIdentity;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function getOneById(UserIdentity $userIdentity): User
    {
        $user = $this->findOneById($userIdentity);

        if ($user === null) {
            throw UserNotFoundException::fromUserId($userIdentity);
        }

        return $user;
    }

    public function findOneById(UserIdentity $userIdentity): ?User
    {
        return $this->createQueryBuilder('user')
            ->where('user.id = :id')
            ->setParameter('id', $userIdentity->id())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function add(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
    }

    public function nextIdentity(): UserIdentity
    {
        return UserIdentity::instance();
    }
}
