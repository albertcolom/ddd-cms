<?php

namespace CmsBundle\Cms\Application\Model\Page\CommandHandler\CreatePage;

use CmsBundle\Cms\Application\Model\Common\CommandHandler\Command;
use CmsBundle\Cms\Application\Model\Common\CommandHandler\CommandHandler;
use CmsBundle\Cms\Domain\Model\Page\Entity\Page;
use CmsBundle\Cms\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Cms\Domain\Model\Page\ValueObject\PageIdentity;
use CmsBundle\Cms\Domain\Model\Site\Entity\Site;
use CmsBundle\Cms\Domain\Model\Site\Repository\SiteRepository;
use CmsBundle\Cms\Domain\Model\Site\ValueObject\SiteIdentity;
use CmsBundle\Cms\Domain\Model\User\Entity\User;
use CmsBundle\Cms\Domain\Model\User\Repository\UserRepository;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;

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
        /** @var UserIdentity $userIdentity */
        $userIdentity = UserIdentity::instanceFromId($command->userId());
        $user = $this->userRepository->getOneById($userIdentity);

        /** @var SiteIdentity $siteIdentity */
        $siteIdentity = SiteIdentity::instanceFromId($command->siteId());
        $site = $this->siteRepository->getOneById($siteIdentity);

        $page = $this->createPage($command, $user, $site);

        $this->pageRepository->add($page);

        return CreatePageCommandResult::instance($page);
    }

    /**
     * @param CreatePageCommand $command
     * @param User $user
     * @param Site $site
     * @return Page
     */
    private function createPage(CreatePageCommand $command, User $user, Site $site): Page
    {
        return Page::instance(
            PageIdentity::instance(),
            $user,
            $site,
            $command->content()
        );
    }
}
