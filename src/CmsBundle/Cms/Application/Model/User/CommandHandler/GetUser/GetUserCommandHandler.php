<?php

namespace CmsBundle\Cms\Application\Model\User\CommandHandler\GetUser;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandHandler;
use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\Repository\UserRepository;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;

class GetUserCommandHandler implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Command|GetUserCommand $command
     * @return GetUserCommandResult
     */
    public function handle(Command $command)
    {
        /** @var UserIdentity $userIdentity */
        $userIdentity = UserIdentity::instanceFromId($command->id());

        /** @var User $user */
        $user = $this->userRepository->getOneById($userIdentity);

        return GetUserCommandResult::instance($user);
    }
}
