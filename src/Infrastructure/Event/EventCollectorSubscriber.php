<?php

namespace App\Infrastructure\Event;

use App\Domain\Common\Event\DomainEventSubscriber;

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
