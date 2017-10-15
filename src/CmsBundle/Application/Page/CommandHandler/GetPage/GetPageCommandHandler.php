<?php

namespace CmsBundle\Application\Page\CommandHandler\GetPage;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Entity\Page;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;

class GetPageCommandHandler implements CommandHandler
{
    /** @var PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Command|GetPageCommand $command
     * @return GetPageCommandResult
     */
    public function handle(Command $command)
    {
        /** @var PageIdentity $pageIdentity */
        $pageIdentity = PageIdentity::instanceFromId($command->id());
        /** @var Page $page */
        $page = $this->pageRepository->getOneById($pageIdentity);

        return GetPageCommandResult::instance($page);
    }
}
