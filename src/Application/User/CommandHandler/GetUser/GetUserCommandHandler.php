<?php

namespace App\Application\User\CommandHandler\GetUser;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\ValueObject\UserIdentity;

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
        $user = $this->userRepository->getOneById($userIdentity);

        return GetUserCommandResult::instance($user);
    }
}
