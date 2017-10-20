<?php

namespace CmsBundle\Domain\Model\Page\Repository;

use CmsBundle\Domain\Model\Page\Entity\Page;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;

interface PageRepository
{
    public function getOneById(PageIdentity $pageIdentity): Page;

    public function findAllPages(array $filter, array $order, int $limit, int $offset);

    public function add(Page $page): void;

    public function nextIdentity(): PageIdentity;
}