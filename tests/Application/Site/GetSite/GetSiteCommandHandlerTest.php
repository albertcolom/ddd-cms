<?php

namespace Tests\App\Application\User\CommandHandler\CreateSite;

use App\Application\Site\CommandHandler\GetSite\GetSiteCommand;
use App\Application\Site\CommandHandler\GetSite\GetSiteCommandHandler;
use App\Application\Site\CommandHandler\GetSite\GetSiteCommandResult;
use App\Domain\Site\Entity\Site;
use App\Domain\Site\Repository\SiteRepository;
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
