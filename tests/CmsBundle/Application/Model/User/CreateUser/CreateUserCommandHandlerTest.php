<?php

namespace Tests\CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser;

use CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser\CreateUserCommand;
use CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser\CreateUserCommandHandler;
use CmsBundle\Cms\Application\Model\User\CommandHandler\CreateUser\CreateUserCommandResult;
use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\Repository\UserRepository;
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
