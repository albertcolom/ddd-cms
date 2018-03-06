<?php

namespace App\Application\User\CommandHandler\CreateUser;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\ValueObject\UserIdentity;

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
