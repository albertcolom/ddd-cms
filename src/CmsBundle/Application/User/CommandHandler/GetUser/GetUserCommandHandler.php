<?php

namespace CmsBundle\Application\User\CommandHandler\GetUser;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\User\Entity\User;
use CmsBundle\Domain\Model\User\Repository\UserRepository;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

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
