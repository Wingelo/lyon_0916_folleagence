<?php

namespace MigrationBundle\Repository;

use Doctrine\ORM\EntityRepository;

class WpCommentsRepository extends EntityRepository
{
    public function getComments()
    {
        $em = $this->createQueryBuilder('c')
                   ->where("c.commentApproved = '1'")
                   ->getQuery();
        return $em->getResult();
    }
}
