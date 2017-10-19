<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPages;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;

class FindPagesCommandHandler implements CommandHandler
{
    /** @var PageRepository  */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Command|FindPagesCommand $command
     * @return array
     */
    public function handle(Command $command)
    {
        return $this->pageRepository->findAllPages(
            $command->param()->filter(),
            $command->param()->order(),
            $command->param()->limit(),
            $command->param()->offset()
        );
    }
}
