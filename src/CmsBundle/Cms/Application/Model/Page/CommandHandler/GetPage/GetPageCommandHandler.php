<?php

namespace CmsBundle\Cms\Application\Model\Page\CommandHandler\GetPage;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandHandler;
use CmsBundle\Cms\Domain\Model\Page\Entity\Page;
use CmsBundle\Cms\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Cms\Domain\Model\Page\ValueObject\PageIdentity;

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
        $page = $this->pageRepository->getOneById($pageIdentity);

        return GetPageCommandResult::instance($page);
    }
}
