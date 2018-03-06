<?php

namespace App\Infrastructure\Domain\Site\ValueObject;

use App\Domain\Site\ValueObject\SiteIdentity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoctrineSiteIdentityType extends GuidType
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
        return (null === $value) ? null : SiteIdentity::instanceFromId((string)$value);
    }
}
