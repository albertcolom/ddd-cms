<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\UserIdentity;

interface UserRepository
{
    public function getOneById(UserIdentity $userIdentity): User;

    public function findOneById(UserIdentity $userIdentity): ?User;

    public function add(User $user): void;

    public function nextIdentity(): UserIdentity;
}
