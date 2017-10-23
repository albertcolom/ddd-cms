<?php

namespace CmsBundle\Cms\Application\Model\Site\CommandHandler\CreateSite;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;

class CreateSiteCommand implements Command
{
    /** @var string  */
    private $name;

    /** @var string  */
    private $description;

    /**
     * @param string $name
     * @param string $description
     */
    private function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @param string $name
     * @param string $description
     * @return CreateSiteCommand
     */
    public static function instance(string $name, string $description): CreateSiteCommand
    {
        return new self($name, $description);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }
}