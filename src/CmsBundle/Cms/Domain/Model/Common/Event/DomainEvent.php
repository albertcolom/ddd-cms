<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

interface DomainEvent
{
    public function id(): string;

    public function type(): string;

    public function occurredOn(): \DateTimeImmutable;
}
