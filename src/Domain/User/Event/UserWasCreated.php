<?php

namespace App\Domain\User\Event;

use App\Domain\Common\Event\AbstractDomainEvent;
use App\Domain\User\ValueObject\UserIdentity;

class UserWasCreated extends AbstractDomainEvent
{
    /** @var string */
    private $userId;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    public function __construct(UserIdentity $siteIdentity, string $name, string $email)
    {
        parent::__construct();
        $this->userId = $siteIdentity->id();
        $this->name = $name;
        $this->email = $email;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}
