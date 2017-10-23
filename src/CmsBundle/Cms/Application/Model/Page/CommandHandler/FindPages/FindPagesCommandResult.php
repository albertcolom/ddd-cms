<?php

namespace CmsBundle\Cms\Application\Model\Page\CommandHandler\FindPages;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandResult;
use CmsBundle\Cms\Domain\Model\Page\Entity\Page;

class FindPagesCommandResult implements CommandResult
{
    /** @var Page[] */
    private $pages;

    private function __construct($pages)
    {
        $this->pages = $pages;
    }

    public static function instance($pages): FindPagesCommandResult
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
