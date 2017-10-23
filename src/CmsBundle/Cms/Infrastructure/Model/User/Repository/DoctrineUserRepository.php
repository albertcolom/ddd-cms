<?php

namespace CmsBundle\Cms\Infrastructure\Model\User\Repository;

use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\Exception\UserNotFoundException;
use CmsBundle\Cms\Domain\Model\User\Repository\UserRepository;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;
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
