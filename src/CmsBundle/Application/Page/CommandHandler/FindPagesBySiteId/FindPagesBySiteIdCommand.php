<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

class FindPagesBySiteIdCommand implements Command
{
    /** @var PageIdentity */
    private $pageIdentity;

    private function __construct(string $id)
    {
        $this->pageIdentity = PageIdentity::instanceFromId($id);
    }

    public static function instance(string $id): FindPagesBySiteIdCommand
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
