<?php

namespace App\Domain\Site\Exception;

use App\Domain\Common\Exception\NotFoundException;

class SiteNotFoundException extends NotFoundException
{
    public static function fromSiteId(string $id)
    {
        return new self(sprintf('Site with id "%s" not found', $id));
    }
}
