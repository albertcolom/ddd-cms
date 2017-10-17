<?php

namespace CmsBundle\Domain\Model\Page\Exception;

use CmsBundle\Domain\Model\Common\Exception\NotFoundException;

class PageNotFoundException extends NotFoundException
{
    public static function fromPageId(string $id)
    {
        return new self(sprintf('Page with id "%s" not found', $id));
    }
}
