<?php

namespace CmsBundle\Application\User\CommandHandler\GetUser;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

class GetUserCommand implements Command
{
    /** @var UserIdentity */
    private $userIdentity;

    private function __construct(string $id)
    {
        $this->userIdentity = UserIdentity::instanceFromId($id);
    }

    public static function instance(string $id): GetUserCommand
    {
        return new self($id);
    }

    /**
     * @return UserIdentity
     */
    public function userIdentity(): UserIdentity
    {
        return $this->userIdentity;
    }
}