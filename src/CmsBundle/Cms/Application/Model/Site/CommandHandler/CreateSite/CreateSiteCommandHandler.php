<?php

namespace CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandHandler;
use CmsBundle\Cms\Domain\Model\Site\Entity\Site;
use CmsBundle\Cms\Domain\Model\Site\Repository\SiteRepository;
use CmsBundle\Cms\Domain\Model\Site\ValueObject\SiteIdentity;

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
