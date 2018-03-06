<?php

namespace App\Application\Page\CommandHandler\CreatePage;

use App\Application\Common\CommandHandler\Command;
use App\Application\Common\CommandHandler\CommandHandler;
use App\Domain\Page\Entity\Page;
use App\Domain\Page\Repository\PageRepository;
use App\Domain\Page\ValueObject\PageIdentity;
use App\Domain\Site\Entity\Site;
use App\Domain\Site\Repository\SiteRepository;
use App\Domain\Site\ValueObject\SiteIdentity;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\ValueObject\UserIdentity;

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
