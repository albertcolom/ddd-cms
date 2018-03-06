<?php

namespace App\Infrastructure\Domain\Page\ValueObject;

use App\Domain\Page\ValueObject\PageIdentity;
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
