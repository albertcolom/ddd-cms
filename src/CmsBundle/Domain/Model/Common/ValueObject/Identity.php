<?php

namespace CmsBundle\Domain\Model\Common\ValueObject;

use Ramsey\Uuid\Uuid;

abstract class Identity
{
    /** @var string */
    private $id;

    /**
     * @param string $id
     */
    private function __construct(string $id = null)
    {
        $this->setId($id ?: Uuid::uuid4()->toString());
    }

    /**
     * @return Identity
     */
    public static function instance(): Identity
    {
        return new static();
    }

    /**
     * @param string $id
     *
     * @return Identity
     */
    public static function instanceFromId(string $id): Identity
    {
        return new static($id);
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    private function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param Identity $identity
     *
     * @return bool
     */
    public function equals(Identity $identity): bool
    {
        return $this->id() === $identity->id();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id();
    }
}
