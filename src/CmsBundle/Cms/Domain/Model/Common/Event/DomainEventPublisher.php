<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

class DomainEventPublisher
{
    /** @var DomainEventSubscriber */
    private $subscribers = [];

    /** @var DomainEventPublisher  */
    private static $instance = null;

    /** @var int */
    private $id = 0;

    /**
     * @return DomainEventPublisher
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    private function __construct()
    {
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    /**
     * @param $domainEventSubscriber
     * @return int
     */
    public function subscribe($domainEventSubscriber)
    {
        $id = $this->id;
        $this->subscribers[$id] = $domainEventSubscriber;
        $this->id++;

        return $id;
    }

    /**
     * @param $id
     */
    public function unSubscribe($id)
    {
        unset($this->subscribers[$id]);
    }

    /**
     * @param DomainEvent $domainEvent
     */
    public function publish(DomainEvent $domainEvent)
    {
        /** @var DomainEventSubscriber $subscriber */
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($domainEvent)) {
                $subscriber->handle($domainEvent);
            }
        }
    }
}
