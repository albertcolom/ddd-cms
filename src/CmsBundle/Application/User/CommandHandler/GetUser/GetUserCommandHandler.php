<?php

namespace CmsBundle\Application\User\CommandHandler\GetUser;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\User\Entity\User;
use CmsBundle\Domain\Model\User\Repository\UserRepository;

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
        /** @var User $user */
        $user = $this->userRepository->getOneById($command->userIdentity());

        return GetUserCommandResult::instance($user);
    }
}
