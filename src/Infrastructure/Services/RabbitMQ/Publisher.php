<?php

namespace App\Infrastructure\Services\RabbitMQ;

use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class Publisher
{
    /** @var ProducerInterface  */
    private $producer;

    /**
     * Publisher constructor.
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param string $message
     */
    public function publish(string $message)
    {
        $this->producer->publish($message);
    }
}
