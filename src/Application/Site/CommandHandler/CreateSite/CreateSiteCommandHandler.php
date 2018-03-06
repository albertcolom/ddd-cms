<?php

namespace App\Application\Site\CommandHandler\CreateSite;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\Site\Entity\Site;
use App\Domain\Site\Repository\SiteRepository;
use App\Domain\Site\ValueObject\SiteIdentity;

class CreateSiteCommandHandler implements CommandHandler
{
    /** @var SiteRepository  */
    private $siteRepository;

    /**
     * @param SiteRepository $siteRepository
     */
    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }

    /**
     * @param Command|CreateSiteCommand $command
     * @return CreateSiteCommandResult
     */
    public function handle(Command $command)
    {
        $site = $this->createSite($command);

        $this->siteRepository->add($site);

        return CreateSiteCommandResult::instance($site);
    }

    /**
     * @param CreateSiteCommand $command
     * @return Site
     */
    private function createSite(CreateSiteCommand $command): Site
    {
        return Site::instance(
            SiteIdentity::instance(),
            $command->name(),
            $command->description()
        );
    }
}
