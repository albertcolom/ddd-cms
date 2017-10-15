<?php

namespace CmsBundle\Application\Page\CommandHandler\GetPage;

use CmsBundle\Application\Common\CommandHandler\CommandResult;
use CmsBundle\Domain\Model\Page\Entity\Page;

class GetPageCommandResult implements CommandResult
{
    /** @var Page  */
    private $page;

    /**
     * @param Page $page
     */
    private function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @param Page $page
     * @return GetPageCommandResult
     */
    public static function instance(Page $page): GetPageCommandResult
    {
        return new self($page);
    }

    /**
     * @return Page
     */
    public function page(): Page
    {
        return $this->page;
    }
}