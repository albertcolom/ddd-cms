<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesBySiteId;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;

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
        return $this->pageRepository->findBySiteId($command->pageIdentity());
    }
}
