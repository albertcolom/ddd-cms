<?php

namespace CmsBundle\Application\User\CommandHandler\CreateUser;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\User\Entity\User;
use CmsBundle\Domain\Model\User\Repository\UserRepository;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

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
