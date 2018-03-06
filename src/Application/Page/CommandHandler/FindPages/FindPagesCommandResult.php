<?php

namespace App\Application\Page\CommandHandler\FindPages;

use App\Application\Common\CommandHandler\CommandResult;
use App\Domain\Page\Entity\Page;

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
