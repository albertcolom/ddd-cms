<?php

namespace CmsBundle\Cms\Infrastructure\Model\Page\Repository;

use CmsBundle\Cms\Domain\Model\Page\Entity\Page;
use CmsBundle\Cms\Domain\Model\Page\Exception\PageNotFoundException;
use CmsBundle\Cms\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Cms\Domain\Model\Page\ValueObject\PageIdentity;
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
