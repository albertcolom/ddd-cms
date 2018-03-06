<?php

namespace Tests\App\Application\User\CommandHandler\CreateSite;

use App\Application\Site\CommandHandler\CreateSite\CreateSiteCommand;
use App\Application\Site\CommandHandler\CreateSite\CreateSiteCommandHandler;
use App\Application\Site\CommandHandler\CreateSite\CreateSiteCommandResult;
use App\Domain\Site\Entity\Site;
use App\Domain\Site\Repository\SiteRepository;
use PHPUnit\Framework\TestCase;

class CreateSiteCommandHandlerTest extends TestCase
{
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
        $commandHandler = new CreateSiteCommandHandler($this->siteRepositoryMock);

        /** @var CreateSiteCommandResult $commandResult */
        $commandResult = $commandHandler->handle($this->buildCreateSiteCommand());

        $this->assertInstanceOf(Site::class, $commandResult->site());
        $this->assertNotNull($commandResult->site()->id());
    }

    /**
     * @return CreateSiteCommand
     */
    private function buildCreateSiteCommand()
    {
        return CreateSiteCommand::instance(
            'site.name',
            'Some description'
        );
    }
}
