<?php

namespace CmsBundle\Infrastructure\Model\User\ValueObject;

use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoctrineUserIdentityType extends GuidType
{
    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : (string) $value;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : UserIdentity::instanceFromId((string)$value);
    }
}
