<?php

namespace App\Infrastructure\Event;

use Elastica\Document;
use FOS\ElasticaBundle\Elastica\Index;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ElasticEventStore implements ConsumerInterface
{
    /** @var Index  */
    private $index;

    /**
     * ElasticEventStore constructor.
     * @param Index $index
     */
    public function __construct(Index $index)
    {
        $this->index = $index;
    }

    /**
     * @param AMQPMessage $msg
     * @return int
     */
    public function execute(AMQPMessage $msg): int
    {
        try {
            $event = json_decode($msg->getBody(), true);
            $this->store($event);
        } catch (\Exception $exception) {
            echo $exception->getMessage()."\n";
            return self::MSG_REJECT_REQUEUE;
        }

        return self::MSG_ACK;
    }

    /**
     * @param array $event
     */
    private function store(array $event)
    {
        $typeName = explode('\\', $event['event_type']);

        $type = $this->index->getType(end($typeName));
        $doc = new Document($event['event_id'], $event);

        $type->addDocument($doc);
    }
}
