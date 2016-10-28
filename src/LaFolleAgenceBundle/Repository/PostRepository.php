<?php

namespace LaFolleAgenceBundle\Repository;

use LaFolleAgenceBundle\Entity\Category;
use LaFolleAgenceBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    const MAX_RESULT = 3;
    /**
     * @param int $page
     * @param int $itemPerPage
     * @return Paginator
     */
    public function getByPage($page, $itemPerPage = self::MAX_RESULT)
    {
        if ($page > 0) {
            $offset = ($page - 1) * $itemPerPage;
        } else {
            $offset = 0;
        }
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.publicationDate', 'DESC')
            ->where('p.statut = 1')
            ->setFirstResult($offset)
            ->setMaxResults($itemPerPage)
            ;
        return new Paginator($query);
    }

    /**
     * @param $category
     * @param $page
     * @param int $itemPerPage
     * @return Paginator
     */
    public function categoryGetByPage(Category $category, $page, $itemPerPage = self::MAX_RESULT)
    {
        if ($page > 0) {
            $offset = ($page - 1) * $itemPerPage;
        } else {
            $offset = 0;
        }
        $query = $this->createQueryBuilder('p')
            //->select('post', 'p')
            ->join('category', 'c')
            ->where('c.id = ?1')
            ->setParameter(1, $category->getId())
            ->setFirstResult($offset)
            ->setMaxResults($itemPerPage)
        ;
        return new Paginator($query);
    }

    public function getLastSixArticles ($limit) {
        $carouselArticles = $this->createQueryBuilder('la')
            ->orderBy('la.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();
        return $carouselArticles->getResult();
    }

    public function getAllOrderByDate()
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.publicationDate', 'DESC')
            ->where('p.statut = 1');

        return new Paginator($query);
    }


    public function getPrecedent(Post $post)
    {
        $publicationDate = $post->getPublicationDate()->format('m-d-Y');
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.publicationDate', 'DESC')
            ->where('p.statut = 1')
            ->setMaxResults(1)
            ->andWhere("p.publicationDate < $publicationDate")
            ->getQuery();

        return $query->getResult();
    }

    public function getSuivant(Post $post)
    {
        $publicationDate = $post->getPublicationDate()->format('m-d-Y');
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.publicationDate', 'ASC')
            ->where('p.statut = 1')
            ->setMaxResults(1)
            ->andWhere("p.publicationDate > $publicationDate")
            ->getQuery();

        return $query->getResult();
    }

    public function getComments() {
        $comments = $this->createQueryBuilder('co')
            ->orderBy('co.id', 'DESC')
            ->getQuery();
        return $comments->getResult();

    }
}
