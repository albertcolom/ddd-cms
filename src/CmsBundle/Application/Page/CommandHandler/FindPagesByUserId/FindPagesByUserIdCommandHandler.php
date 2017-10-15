<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesByUserId;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;

class FindPagesByUserIdCommandHandler implements CommandHandler
{
    /** @var PageRepository  */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Command|FindPagesByUserIdCommand $command
     */
    public function handle(Command $command)
    {
        return $this->pageRepository->findByUserId($command->userIdentity());
    }
}
