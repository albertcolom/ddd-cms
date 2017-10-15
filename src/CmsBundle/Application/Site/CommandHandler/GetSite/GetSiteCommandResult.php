<?php

namespace CmsBundle\Application\Site\CommandHandler\GetSite;

use CmsBundle\Application\Common\CommandHandler\CommandResult;
use CmsBundle\Domain\Model\Site\Entity\Site;

class GetSiteCommandResult implements CommandResult
{
    /** @var Site  */
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
     * @return GetSiteCommandResult
     */
    public static function instance(Site $site): GetSiteCommandResult
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