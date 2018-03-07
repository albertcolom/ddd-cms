<?php

namespace App\Infrastructure\Services\Bus\Middleware;

use App\Domain\Common\Event\DomainEventPublisher;
use App\Infrastructure\Event\EventCollectorSubscriber;
use App\Infrastructure\Services\RabbitMQ\Publisher;
use JMS\Serializer\SerializerInterface;
use League\Tactician\Middleware;

class EventPublisherMiddleware implements Middleware
{
    /** @var Publisher  */
    private $publisher;

    /** @var SerializerInterface  */
    private $serializer;

    /**
     * EventPublisherMiddleware constructor.
     * @param Publisher $publisher
     * @param SerializerInterface $serializer
     */
    public function __construct(Publisher $publisher, SerializerInterface $serializer)
    {
        $this->publisher = $publisher;
        $this->serializer = $serializer;
    }

    public function execute($command, callable $next)
    {
        $domainEventPublisher = DomainEventPublisher::instance();
        $domainEventCollector = new EventCollectorSubscriber();
        $domainEventPublisher->subscribe($domainEventCollector);

        $returnValue = $next($command);

        $events = $domainEventCollector->events();

        foreach ($events as $event) {
            $serializeEvent = $this->serializer->serialize($event, 'json');
            $this->publisher->publish($serializeEvent);
        }

        return $returnValue;
    }
}
