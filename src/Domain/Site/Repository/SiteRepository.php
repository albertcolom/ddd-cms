<?php

namespace App\Domain\Site\Repository;

use App\Domain\Site\Entity\Site;
use App\Domain\Site\ValueObject\SiteIdentity;

interface SiteRepository
{
    public function getOneById(SiteIdentity $siteIdentity): Site;

    public function findOneById(SiteIdentity $siteIdentity): ?Site;

    public function add(Site $site): void;

    public function nextIdentity(): SiteIdentity;
}
