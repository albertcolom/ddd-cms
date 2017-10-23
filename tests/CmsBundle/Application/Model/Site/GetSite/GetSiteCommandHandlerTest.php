<?php

namespace Tests\CmsBundle\Cms\Application\Model\User\CommandHandler\CreateSite;

use CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommand;
use CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommandHandler;
use CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite\GetSiteCommandResult;
use CmsBundle\Cms\Domain\Model\Site\Entity\Site;
use CmsBundle\Cms\Domain\Model\Site\Repository\SiteRepository;
use PHPUnit\Framework\TestCase;

class GetSiteCommandHandlerTest extends TestCase
{
    const VALID_UUID = '6976e6ed-7672-4791-a686-415dd7a88cdf';

    /** @var SiteRepository */
    private $siteRepositoryMock;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->siteRepositoryMock = $this->createMock(SiteRepository::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->siteRepositoryMock = null;
    }

    /**
     * @test
     */
    public function itShouldReturnCreatedExpectedSite()
    {
        $commandHandler = new GetSiteCommandHandler($this->siteRepositoryMock);

        /** @var GetSiteCommandResult $commandResult */
        $commandResult = $commandHandler->handle($this->buildGetSiteCommand());

        $this->assertInstanceOf(Site::class, $commandResult->site());
        $this->assertNotNull($commandResult->site());
    }

    /**
     * @return GetSiteCommand
     */
    private function buildGetSiteCommand()
    {
        return GetSiteCommand::instance(self::VALID_UUID);
    }
}
