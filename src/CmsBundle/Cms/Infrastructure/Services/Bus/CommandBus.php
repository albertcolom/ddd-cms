<?php

namespace CmsBundle\Cms\Infrastructure\Services\Bus;

use League\Tactician\CommandBus as Bus;

class CommandBus
{
    /** @var Bus */
    private $bus;

    /**
     * CommandBus constructor.
     * @param Bus $bus
     */
    public function __construct(Bus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param object $commandRequest
     * @return mixed
     */
    public function handle($commandRequest)
    {
        return $this->bus->handle($commandRequest);
    }
}
