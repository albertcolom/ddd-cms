<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;

class FindPagesBySiteIdCommandHandler implements CommandHandler
{
    /** @var PageRepository  */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Command|FindPagesBySiteIdCommand $command
     * @return array
     */
    public function handle(Command $command)
    {
        /** @var PageIdentity $pageIdentity */
        $pageIdentity = PageIdentity::instanceFromId($command->id());

        return $this->pageRepository->findBySiteId($pageIdentity);
    }
}
