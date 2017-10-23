<?php

namespace Tests\CmsBundle\Cms\Application\Model\User\CommandHandler\CreatePage;

use CmsBundle\Cms\Application\Model\Page\CommandHandler\CreatePage\CreatePageCommand;
use CmsBundle\Cms\Application\Model\Page\CommandHandler\CreatePage\CreatePageCommandHandler;
use CmsBundle\Cms\Application\Model\Page\CommandHandler\CreatePage\CreatePageCommandResult;
use CmsBundle\Cms\Application\Model\Page\CommandHandler\GetPage\GetPageCommand;
use CmsBundle\Cms\Application\Model\Page\CommandHandler\GetPage\GetPageCommandHandler;
use CmsBundle\Cms\Application\Model\Page\CommandHandler\GetPage\GetPageCommandResult;
use CmsBundle\Cms\Domain\Model\Page\Entity\Page;
use CmsBundle\Cms\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Cms\Domain\Model\Site\Repository\SiteRepository;
use CmsBundle\Cms\Domain\Model\User\Repository\UserRepository;
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
        $this->assertNotNull($commandResult->page()->id());
    }

    /**
     * @return GetPageCommand
     */
    private function buildGetPageCommand()
    {
        return GetPageCommand::instance(self::VALID_UUID);
    }
}
