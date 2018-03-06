<?php

namespace Tests\App\Application\User\CommandHandler\GetUser;

use App\Application\User\CommandHandler\GetUser\GetUserCommand;
use App\Application\User\CommandHandler\GetUser\GetUserCommandHandler;
use App\Application\User\CommandHandler\GetUser\GetUserCommandResult;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreateUserCommandHandlerTest extends TestCase
{
    const VALID_UUID = '6976e6ed-7672-4791-a686-415dd7a88cdf';

    /** @var UserRepository */
    private $userRepositoryMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->userRepositoryMock = null;
    }

    /**
     * @test
     */
    public function itShouldReturnGetExpectedUser()
    {
        $commandHandler = new GetUserCommandHandler($this->userRepositoryMock);

        /** @var GetUserCommandResult $commandResult */
        $commandResult = $commandHandler->handle($this->buildGetUserCommand());

        $this->assertInstanceOf(User::class, $commandResult->user());
        $this->assertNotNull($commandResult->user());
    }

    /**
     * @return GetUserCommand
     */
    private function buildGetUserCommand()
    {
        return GetUserCommand::instance(self::VALID_UUID);
    }
}
