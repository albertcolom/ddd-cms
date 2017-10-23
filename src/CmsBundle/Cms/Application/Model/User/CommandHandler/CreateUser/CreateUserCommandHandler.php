<?php

namespace CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandHandler;
use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\Repository\UserRepository;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;

class CreateUserCommandHandler implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Command|CreateUserCommand $command
     * @return CreateUserCommandResult
     */
    public function handle(Command $command)
    {
        $user = $this->createUser($command);

        $this->userRepository->add($user);

        return CreateUserCommandResult::instance($user);
    }

    private function createUser(CreateUserCommand $command): User
    {
        return User::instance(
            UserIdentity::instance(),
            $command->name(),
            $command->email()
        );
    }
}
