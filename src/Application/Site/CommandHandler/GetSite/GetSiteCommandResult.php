<?php

namespace App\Application\Site\CommandHandler\GetSite;

use App\Application\Common\CommandHandler\CommandResult;
use App\Domain\Site\Entity\Site;

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
