<?php

namespace CmsBundle\Application\Page\CommandHandler\FindPagesByUserId;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

class FindPagesByUserIdCommandHandler implements CommandHandler
{
    /** @var PageRepository  */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Command $command
     * @return array
     */
    public function handle(Command $command)
    {
        /** @var UserIdentity $userIdentity */
        $userIdentity = UserIdentity::instanceFromId($command->id());

        return $this->pageRepository->findByUserId($userIdentity);
    }
}
