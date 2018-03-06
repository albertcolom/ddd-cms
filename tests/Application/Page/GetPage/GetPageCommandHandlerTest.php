<?php

namespace Tests\App\Application\User\CommandHandler\CreatePage;

use App\Application\Page\CommandHandler\GetPage\GetPageCommand;
use App\Application\Page\CommandHandler\GetPage\GetPageCommandHandler;
use App\Application\Page\CommandHandler\GetPage\GetPageCommandResult;
use App\Domain\Page\Entity\Page;
use App\Domain\Page\Repository\PageRepository;
use PHPUnit\Framework\TestCase;

class GetPageCommandHandlerTest extends TestCase
{
    const VALID_UUID = '6976e6ed-7672-4791-a686-415dd7a88cdf';

    /** @var PageRepository */
    private $pageRepositoryMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->pageRepositoryMock = $this->createMock(PageRepository::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->pageRepositoryMock = null;
    }

    /**
     * @test
     */
    public function itShouldReturnCreatedExpectedPage()
    {
        $commandHandler = new GetPageCommandHandler($this->pageRepositoryMock);

        /** @var GetPageCommandResult $commandResult */
        $commandResult = $commandHandler->handle($this->buildGetPageCommand());

        $this->assertInstanceOf(Page::class, $commandResult->page());
        $this->assertNotNull($commandResult->page());
    }

    /**
     * @return GetPageCommand
     */
    private function buildGetPageCommand()
    {
        return GetPageCommand::instance(self::VALID_UUID);
    }
}
