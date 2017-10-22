<?php

namespace CmsBundle\Domain\Model\Common\Event;

abstract class Event
{
    /** @var EventIdentity */
    private $id;

    /** @var \DateTimeImmutable */
    private $occurredOn;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->id = EventIdentity::instance();
        $this->occurredOn = new \DateTimeImmutable();
    }

    /**
     * @return EventIdentity
     */
    public function id(): EventIdentity
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}