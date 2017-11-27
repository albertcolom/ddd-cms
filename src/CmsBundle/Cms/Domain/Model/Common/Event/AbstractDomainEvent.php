<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

abstract class AbstractDomainEvent implements DomainEvent
{
    /** @var string */
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
        $this->id = DomainEventIdentity::instance()->id();
        $this->setType();
        $this->occurredOn = new \DateTimeImmutable();
    }

    private function setType()
    {
        $path = explode('\\', get_class($this));
        $this->type = array_pop($path);
    }

    /**
     * @return string
     */
    public function id(): string
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
