<?php

namespace Tests\App\Application\User\CommandHandler\CreateUser;

use App\Application\User\CommandHandler\CreateUser\CreateUserCommand;
use App\Application\User\CommandHandler\CreateUser\CreateUserCommandHandler;
use App\Application\User\CommandHandler\CreateUser\CreateUserCommandResult;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreateUserCommandHandlerTest extends TestCase
{
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
    public function itShouldReturnCreatedExpectedUser()
    {
        $commandHandler = new CreateUserCommandHandler($this->userRepositoryMock);

        /** @var CreateUserCommandResult $commandResult */
        $commandResult = $commandHandler->handle($this->buildCreateUserCommand());

        $this->assertInstanceOf(User::class, $commandResult->user());
        $this->assertNotNull($commandResult->user()->id());
    }

    /**
     * @return CreateUserCommand
     */
    private function buildCreateUserCommand()
    {
        return CreateUserCommand::instance(
            'user.name',
            'valid_mail@gmail.com'
        );
    }
}
