<?php

namespace App\Application\Site\CommandHandler\GetSite;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\Site\Entity\Site;
use App\Domain\Site\Repository\SiteRepository;
use App\Domain\Site\ValueObject\SiteIdentity;

class GetSiteCommandHandler implements CommandHandler
{
    /** @var SiteRepository  */
    private $siteRepository;

    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }

    /**
     * @param Command|GetSiteCommand $command
     * @return GetSiteCommandResult
     */
    public function handle(Command $command)
    {
        /** @var SiteIdentity $siteIdentity */
        $siteIdentity = SiteIdentity::instanceFromId($command->id());
        $site = $this->siteRepository->getOneById($siteIdentity);

        return GetSiteCommandResult::instance($site);
    }
}
