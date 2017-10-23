<?php

namespace CmsBundle\Cms\Application\Model\Site\CommandHandler\GetSite;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandHandler;
use CmsBundle\Cms\Domain\Model\Site\Entity\Site;
use CmsBundle\Cms\Domain\Model\Site\Repository\SiteRepository;
use CmsBundle\Cms\Domain\Model\Site\ValueObject\SiteIdentity;

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

        /** @var Site $site */
        $site = $this->siteRepository->getOneById($siteIdentity);

        return GetSiteCommandResult::instance($site);
    }
}
