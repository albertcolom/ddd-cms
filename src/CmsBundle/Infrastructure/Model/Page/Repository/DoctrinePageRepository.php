<?php

namespace CmsBundle\Infrastructure\Model\Page\Repository;

use CmsBundle\Domain\Model\Page\Entity\Page;
use CmsBundle\Domain\Model\Page\Exception\PageNotFoundException;
use CmsBundle\Domain\Model\Page\Repository\PageRepository;
use CmsBundle\Domain\Model\Page\ValueObject\PageIdentity;
use CmsBundle\Domain\Model\User\ValueObject\UserIdentity;
use Doctrine\ORM\EntityRepository;

class DoctrinePageRepository extends EntityRepository implements PageRepository
{
    public function getOneById(PageIdentity $pageIdentity): Page
    {
        $page = $this->findOneById($pageIdentity);

        if ($page === null){
            throw new PageNotFoundException();
        }

        return $page;
    }

    public function findOneById(PageIdentity $pageIdentity): ?Page
    {
        return $this->createQueryBuilder('page')
            ->where('page.id = :id')
            ->setParameter('id', $pageIdentity->id())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findBySiteId(PageIdentity $siteIdentity): array
    {
        return $this->createQueryBuilder('page')
            ->where('page.site = :siteId')
            ->setParameter('siteId', $siteIdentity->id())
            ->getQuery()
            ->getResult();
    }

    public function findByUserId(UserIdentity $userIdentity): array
    {
        return $this->createQueryBuilder('page')
            ->where('page.user = :userId')
            ->setParameter('userId', $userIdentity->id())
            ->getQuery()
            ->getResult();
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
