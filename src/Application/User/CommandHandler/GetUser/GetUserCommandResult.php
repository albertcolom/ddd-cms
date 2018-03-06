<?php

namespace App\Application\User\CommandHandler\GetUser;

use App\Application\Common\CommandHandler\CommandResult;
use App\Domain\User\Entity\User;

class GetUserCommandResult implements CommandResult
{
    /** @var User  */
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
     * @return GetUserCommandResult
     */
    public static function instance(User $user): GetUserCommandResult
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
