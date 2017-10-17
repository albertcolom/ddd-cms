<?php

namespace CmsBundle\Application\Site\CommandHandler\GetSite;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Site\Entity\Site;
use CmsBundle\Domain\Model\Site\Repository\SiteRepository;

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
        /** @var Site $site */
        $site = $this->siteRepository->getOneById($command->siteIdentity());

        return GetSiteCommandResult::instance($site);
    }
}
