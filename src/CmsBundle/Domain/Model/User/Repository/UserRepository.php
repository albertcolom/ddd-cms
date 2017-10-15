<?php

namespace CmsBundle\Domain\Model\User\Repository;

use CmsBundle\Domain\Model\User\Entity\User;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

interface UserRepository
{
    public function getOneById(UserIdentity $userIdentity): User;

    public function findOneById(UserIdentity $userIdentity): ?User;

    public function add(User $user): void;

    public function nextIdentity(): UserIdentity;
}