<?php

namespace CmsBundle\Infrastructure\Model\Page\Repository;

use CmsBundle\Domain\Model\Page\Entity\Page;
use CmsBundle\Domain\Model\Page\Exception\PageNotFoundException;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;
use Doctrine\ORM\EntityRepository;

class DoctrinePageRepository extends EntityRepository implements PageRepository
{
    public function getOneById(PageIdentity $pageIdentity): Page
    {
        /** @var Page $page */
        $page = $this->findOneBy(['id' => $pageIdentity]);

        if ($page === null){
            throw PageNotFoundException::fromPageId($pageIdentity);
        }

        return $page;
    }

    public function findAllPages(array $filter, array $order, int $limit, int $offset)
    {
        return $this->findBy($filter, $order, $limit, $offset);
    }

    public function add(Page $page): void
    {
        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush($page);
    }

    public function nextIdentity(): PageIdentity
    {
        return PageIdentity::instance();
    }
}
