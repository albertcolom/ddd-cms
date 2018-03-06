<?php

namespace App\Application\Site\CommandHandler\CreateSite;

use App\Application\Common\CommandHandler\CommandResult;
use App\Domain\Site\Entity\Site;

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
