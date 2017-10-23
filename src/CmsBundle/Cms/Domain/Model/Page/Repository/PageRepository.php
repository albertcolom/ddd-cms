<?php

namespace CmsBundle\Cms\Domain\Model\Page\Repository;

use CmsBundle\Cms\Domain\Model\Page\Entity\Page;
use CmsBundle\Cms\Domain\Model\Page\ValueObject\PageIdentity;
use CmsBundle\Cms\Domain\Model\User\ValueObject\UserIdentity;

interface PageRepository
{
    public function getOneById(PageIdentity $pageIdentity): Page;

    public function findAllPages(array $filter, array $order, int $limit, int $offset);

    public function add(Page $page): void;

    public function nextIdentity(): PageIdentity;
}