<?php

namespace CmsBundle\Cms\Domain\Model\Common\Event;

class DomainEventPublisher
{
    /**
     * @var DomainEventPublisher
     */
    private static $instance = null;

    private function __construct()
    {
    }

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

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }


    public function publish(DomainEvent $aDomainEvent)
    {
        foreach ($this->subscribers as $aSubscriber) {
            if ($aSubscriber->isSubscribedTo($aDomainEvent)) {
                $aSubscriber->handle($aDomainEvent);
            }
        }
    }
}
