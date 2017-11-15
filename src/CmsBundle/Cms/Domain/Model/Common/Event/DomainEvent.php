<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

interface DomainEvent
{
    public function id(): DomainEventIdentity;

    public function type(): string;

    public function occurredOn(): \DateTimeImmutable;
}
