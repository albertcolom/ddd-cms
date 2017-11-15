<?php

namespace CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandResult;
use CmsBundle\Cms\Domain\Model\Site\Entity\Site;

class CreateSiteCommandResult implements CommandResult
{
    /** @var Site */
    private $site;

    /**
     * @param Site $site
     */
    private function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * @param Site $site
     * @return CreateSiteCommandResult
     */
    public static function instance(Site $site): CreateSiteCommandResult
    {
        return new self($site);
    }

    /**
     * @return Site
     */
    public function site(): Site
    {
        return $this->site;
    }
}
