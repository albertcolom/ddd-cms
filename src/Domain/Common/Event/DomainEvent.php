<?php

namespace App\Domain\Common\Event;

interface DomainEvent
{
    public function eventId(): string;

    public function eventType(): string;

    public function occurredOn(): \DateTimeImmutable;
}
