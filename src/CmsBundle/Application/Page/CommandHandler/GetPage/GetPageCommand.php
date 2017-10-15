<?php

namespace CmsBundle\Application\Page\CommandHandler\GetPage;

use CmsBundle\Application\Common\CommandHandler\Command;

class GetPageCommand implements Command
{
    /** @var string  */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return GetPageCommand
     */
    public static function instance(string $id): GetPageCommand
    {
        return new self($id);
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}