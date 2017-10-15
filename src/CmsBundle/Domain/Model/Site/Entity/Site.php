<?php

namespace CmsBundle\Domain\Model\Site\Entity;

use CmsBundle\Domain\Model\Site\ValueObject\SiteIdentity;

class Site
{
    /** @var SiteIdentity */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var \DateTime */
    private $createdOn;

    /**
     * @param SiteIdentity $id
     * @param string $name
     * @param string $description
     */
    private function __construct(SiteIdentity $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdOn = new \DateTime();
    }

    /**
     * @param SiteIdentity $id
     * @param string $name
     * @param string $description
     * @return Site
     */
    public static function instance(SiteIdentity $id, string $name, string $description): Site
    {
        return new self($id, $name, $description);
    }

    /**
     * @return SiteIdentity
     */
    public function id(): SiteIdentity
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function createdOn(): \DateTime
    {
        return $this->createdOn;
    }
}
