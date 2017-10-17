<?php

namespace CmsBundle\Application\Site\CommandHandler\GetSite;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Domain\Model\Site\ValueObject\SiteIdentity;

class GetSiteCommand implements Command
{
    /** @var SiteIdentity */
    private $siteIdentity;

    private function __construct(string $id)
    {
        $this->siteIdentity = SiteIdentity::instanceFromId($id);
    }

    public static function instance(string $id): GetSiteCommand
    {
        return new self($id);
    }

    /**
     * @return SiteIdentity
     */
    public function siteIdentity(): SiteIdentity
    {
        return $this->siteIdentity;
    }
}