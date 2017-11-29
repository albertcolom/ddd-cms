<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

abstract class AbstractDomainEvent implements DomainEvent
{
    /** @var string */
    private $eventId;

    /** @var string */
    private $eventType;

    /** @var \DateTimeImmutable */
    private $occurredOn;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->eventId = DomainEventIdentity::instance()->id();
        $this->eventType = get_class($this);
        $this->occurredOn = new \DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function eventId(): string
    {
        return $this->eventId;
    }

    /**
     * @return string
     */
    public function eventType(): string
    {
        return $this->eventType;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
