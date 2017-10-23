<?php

namespace CmsBundle\Cms\Domain\Model\User\Repository;

use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;

interface UserRepository
{
    public function getOneById(UserIdentity $userIdentity): User;

    public function findOneById(UserIdentity $userIdentity): ?User;

    public function add(User $user): void;

    public function nextIdentity(): UserIdentity;
}