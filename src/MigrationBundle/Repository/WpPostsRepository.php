<?php

namespace MigrationBundle\Repository;

use Doctrine\ORM\EntityRepository;

class WpPostsRepository extends EntityRepository
{
    public function getPosts()
    {
        $em = $this->createQueryBuilder('p')
            ->where("p.postType = 'post'")
            ->getQuery();
        return $em->getResult();
    }
}
