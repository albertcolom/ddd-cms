<?php

namespace CmsBundle\Cms\Domain\Model\Site\Exception;

use CmsBundle\Cms\Domain\Model\Common\Exception\NotFoundException;

class SiteNotFoundException extends NotFoundException
{
    public static function fromSiteId(string $id)
    {
        return new self(sprintf('Site with id "%s" not found', $id));
    }
}