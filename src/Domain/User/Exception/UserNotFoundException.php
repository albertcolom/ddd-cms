<?php

namespace App\Domain\User\Exception;

use App\Domain\Common\Exception\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    public static function fromUserId(string $id)
    {
        return new self(sprintf('User with id "%s" not found', $id));
    }
}
