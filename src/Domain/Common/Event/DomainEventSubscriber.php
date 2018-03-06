<?php

namespace App\Domain\Common\Event;

interface DomainEventSubscriber
{
    /**
     * @param $domainEvent
     */
    public function handle($domainEvent);

    /**
     * @param $domainEvent
     * @return bool
     */
    public function isSubscribedTo($domainEvent);
}
