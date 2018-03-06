<?php

namespace App\Application\Page\CommandHandler\FindPages;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\Page\Repository\PageRepository;

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
