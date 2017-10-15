<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId;

use CmsBundle\Application\Common\CommandHandler\CommandResult;
use CmsBundle\Domain\Model\Page\Entity\Page;

class FindPagesBySiteIdCommandResult implements CommandResult
{
    /** @var Page[] */
    private $pages;

    private function __construct($pages)
    {
        $this->pages = $pages;
    }

    public static function instance($pages): FindPagesBySiteIdCommandResult
    {
        return new self($pages);
    }

    /**
     * @return Page[]
     */
    public function pages(): array
    {
        return $this->pages;
    }
}
