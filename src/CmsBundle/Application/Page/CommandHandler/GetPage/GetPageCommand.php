<?php

namespace CmsBundle\Application\Page\CommandHandler\GetPage;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;

class GetPageCommand implements Command
{
    /** @var PageIdentity */
    private $pageIdentity;

    private function __construct(string $id)
    {
        $this->pageIdentity = PageIdentity::instanceFromId($id);
    }

    public static function instance(string $id): GetPageCommand
    {
        return new self($id);
    }

    /**
     * @return PageIdentity
     */
    public function pageIdentity(): PageIdentity
    {
        return $this->pageIdentity;
    }
}