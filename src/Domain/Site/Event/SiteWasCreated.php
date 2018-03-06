<?php

namespace App\Domain\Site\Event;

use App\Domain\Common\Event\AbstractDomainEvent;
use App\Domain\Site\ValueObject\SiteIdentity;

class SiteWasCreated extends AbstractDomainEvent
{
    /** @var string */
    private $siteId;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    public function __construct(SiteIdentity $siteIdentity, string $name, string $description)
    {
        parent::__construct();
        $this->siteId = $siteIdentity->id();
        $this->name = $name;
        $this->description = $description;
    }

    public function siteId(): string
    {
        return $this->siteId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }
}
