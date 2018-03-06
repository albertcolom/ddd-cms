<?php

namespace App\Domain\Page\Repository;

use App\Domain\Page\Entity\Page;
use App\Domain\Page\ValueObject\PageIdentity;
use App\Domain\User\ValueObject\UserIdentity;

interface PageRepository
{
    public function getOneById(PageIdentity $pageIdentity): Page;

    public function findAllPages(array $filter, array $order, int $limit, int $offset);

    public function add(Page $page): void;

    public function nextIdentity(): PageIdentity;
}
