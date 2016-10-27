<?php

namespace MigrationBundle\Repository;

use Doctrine\ORM\EntityRepository;

class WpTermsRepository extends EntityRepository
{
    public function getCategories()
    {
        $em = $this->createQueryBuilder('t')
                   ->select(array('t.termId', 't.name'))
                   ->join('MigrationBundle\Entity\WpTermTaxonomy', 'tt', 'WITH', "t.termId = tt.termId and tt.taxonomy = 'category'")
                   ->getQuery();
        return $em->getResult();
    }
}
