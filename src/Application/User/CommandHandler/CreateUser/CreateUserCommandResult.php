<?php

namespace App\Application\User\CommandHandler\CreateUser;

use App\Application\Common\CommandHandler\CommandResult;
use App\Domain\User\Entity\User;

class CreateUserCommandResult implements CommandResult
{
    /** @var User */
    private $user;

    /**
     * @param User $user
     */
    private function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param User $user
     * @return CreateUserCommandResult
     */
    public static function instance(User $user): createUserCommandResult
    {
        return new self($user);
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }
}
