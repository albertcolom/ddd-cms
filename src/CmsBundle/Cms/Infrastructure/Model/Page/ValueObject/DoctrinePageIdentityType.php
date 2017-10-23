<?php

namespace CmsBundle\Cms\Infrastructure\Model\Page\ValueObject;

use CmsBundle\Cms\Domain\Model\Page\ValueObject\PageIdentity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoctrinePageIdentityType extends GuidType
{
    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : (string) $value->id();
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : PageIdentity::instanceFromId((string)$value);
    }
}
