<?php

namespace App\Domain\Page\Exception;

use App\Domain\Common\Exception\NotFoundException;

class PageNotFoundException extends NotFoundException
{
    public static function fromPageId(string $id)
    {
        return new self(sprintf('Page with id "%s" not found', $id));
    }
}
