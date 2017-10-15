<?php

namespace CmsBundle\Domain\Model\Site\Repository;

use CmsBundle\Domain\Model\Site\Entity\Site;
use CmsBundle\Domain\Model\Site\ValueObject\SiteIdentity;

interface SiteRepository
{
    public function getOneById(SiteIdentity $siteIdentity): Site;

    public function findOneById(SiteIdentity $siteIdentity): ?Site;

    public function add(Site $site): void;

    public function nextIdentity(): SiteIdentity;
}