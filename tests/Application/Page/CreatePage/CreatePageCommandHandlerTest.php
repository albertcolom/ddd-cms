<?php

namespace Tests\App\Application\User\CommandHandler\CreatePage;

use App\Application\Page\CommandHandler\CreatePage\CreatePageCommand;
use App\Application\Page\CommandHandler\CreatePage\CreatePageCommandHandler;
use App\Application\Page\CommandHandler\CreatePage\CreatePageCommandResult;
use App\Domain\Page\Entity\Page;
use App\Domain\Page\Repository\PageRepository;
use App\Domain\Site\Repository\SiteRepository;
use App\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class CreatePageCommandHandlerTest extends TestCase
{
    const VALID_UUID = '6976e6ed-7672-4791-a686-415dd7a88cdf';

    /** @var UserRepository */
    private $userRepositoryMock;

    /** @var SiteRepository*/
    private $siteRepositoryMock;

    /** @var PageRepository */
    private $pageRepositoryMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);
        $this->siteRepositoryMock = $this->createMock(SiteRepository::class);
        $this->pageRepositoryMock = $this->createMock(PageRepository::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->userRepositoryMock = null;
        $this->siteRepositoryMock = null;
        $this->pageRepositoryMock = null;
    }

    /**
     * @test
     */
    public function itShouldReturnCreatedExpectedPage()
    {
        $commandHandler = new CreatePageCommandHandler(
            $this->userRepositoryMock,
            $this->siteRepositoryMock,
            $this->pageRepositoryMock
        );

        /** @var CreatePageCommandResult $commandResult */
        $commandResult = $commandHandler->handle($this->buildCreatePageCommand());

        $this->assertInstanceOf(Page::class, $commandResult->page());
        $this->assertNotNull($commandResult->page()->id());
    }

    /**
     * @return CreatePageCommand
     */
    private function buildCreatePageCommand()
    {
        return CreatePageCommand::instance(
            self::VALID_UUID,
            self::VALID_UUID,
            'Some content'
        );
    }
}
