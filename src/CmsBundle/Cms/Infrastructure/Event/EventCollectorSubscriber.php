<?php

namespace CmsBundle\Cms\Infrastructure\Event;

use CmsBundle\Cms\Domain\Model\Common\Event\DomainEventSubscriber;

class EventCollectorSubscriber implements DomainEventSubscriber
{
    private $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function handle($domainEvent)
    {
        $this->events[] = $domainEvent;
    }

    public function isSubscribedTo($domainEvent)
    {
        return true;
    }

    public function events()
    {
        return $this->events;
    }
}
