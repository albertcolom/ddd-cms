<?php

namespace App\Application\Page\CommandHandler\GetPage;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\Page\Entity\Page;
use App\Domain\Page\Repository\PageRepository;
use App\Domain\Page\ValueObject\PageIdentity;

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
