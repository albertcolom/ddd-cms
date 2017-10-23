<?php

namespace CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandResult;
use CmsBundle\Cms\Domain\Model\User\Entity\User;

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
    public function getUser(): User
    {
        return $this->user;
    }
}
