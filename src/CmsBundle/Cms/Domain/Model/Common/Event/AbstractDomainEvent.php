<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

abstract class AbstractEvent implements Event
{
    /** @var DomainEventIdentity */
    private $id;

    /** @var string */
    private $type;

    /** @var \DateTimeImmutable */
    private $occurredOn;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->id = DomainEventIdentity::instance();
        $this->setType();
        $this->occurredOn = new \DateTimeImmutable();
    }

    private function setType()
    {
        $path = explode('\\', get_class($this));
        $this->type = array_pop($path);
    }

    /**
     * @return DomainEventIdentity
     */
    public function id(): DomainEventIdentity
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}