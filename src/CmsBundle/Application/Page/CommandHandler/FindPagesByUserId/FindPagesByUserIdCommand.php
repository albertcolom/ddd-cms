<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesByUserId;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

class FindPagesByUserIdCommand implements Command
{
    /** @var UserIdentity */
    private $userIdentity;

    private function __construct(string $id)
    {
        $this->userIdentity = UserIdentity::instanceFromId($id);
    }

    public static function instance(string $id): FindPagesByUserIdCommand
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
