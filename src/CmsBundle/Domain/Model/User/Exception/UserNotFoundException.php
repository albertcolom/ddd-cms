<?php

namespace CmsBundle\Domain\Model\User\Exception;

use CmsBundle\Domain\Model\Common\Exception\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    public static function fromUserId(string $id)
    {
        return new self(sprintf('User with id "%s" not found', $id));
    }
}