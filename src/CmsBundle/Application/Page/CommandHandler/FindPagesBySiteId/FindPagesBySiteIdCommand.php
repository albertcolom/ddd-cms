<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId;

use CmsBundle\Application\Common\CommandHandler\Command;

class FindPagesBySiteIdCommand implements Command
{
    /** @var string  */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return FindPagesBySiteIdCommand
     */
    public static function instance(string $id): FindPagesBySiteIdCommand
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
