<?php

namespace CmsBundle\Application\Page\CommandHandler\CreatePage;

use CmsBundle\Application\Common\CommandHandler\Command;
use CmsBundle\Application\Common\CommandHandler\CommandHandler;
use CmsBundle\Domain\Model\Page\Entity\Page;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;
use CmsBundle\Domain\Model\Site\Repository\SiteRepository;
use CmsBundle\Domain\Model\User\Repository\UserRepository;

class CreatePageCommandHandler implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;

    /** @var SiteRepository  */
    private $siteRepository;

    /** @var PageRepository */
    private $pageRepository;

    public function __construct(
        UserRepository $userRepository,
        SiteRepository $siteRepository,
        PageRepository $pageRepository
    ) {
        $this->userRepository = $userRepository;
        $this->siteRepository = $siteRepository;
        $this->pageRepository = $pageRepository;
    }


    /**
     * @param Command|CreatePageCommand $command
     * @return CreatePageCommandResult
     */
    public function handle(Command $command)
    {
       $page = $this->createPage($command);

       $this->pageRepository->add($page);

       return CreatePageCommandResult::instance($page);
    }

    /**
     * @param CreatePageCommand $command
     * @return Page
     */
    private function createPage(CreatePageCommand $command): Page
    {
        return Page::instance(
            PageIdentity::instance(),
            $this->userRepository->getOneById($command->userIdentity()),
            $this->siteRepository->getOneById($command->siteIdentity()),
            $command->content()
        );
    }
}
