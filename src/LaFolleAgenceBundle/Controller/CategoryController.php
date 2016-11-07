<?php

namespace LaFolleAgenceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LaFolleAgenceBundle\Repository\PostRepository;
use LaFolleAgenceBundle\Entity\Category;

use LaFolleAgenceBundle\Form\CategoryType;
use LaFolleAgenceBundle\Entity\PostCategorys;
use Doctrine\DBAL\DriverManager;




/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{

    const MAX_PER_PAGE = 4;

    public function filterIndexAction(Category $category, $page = 1)
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('LaFolleAgenceBundle:Post')->categoryGetByPage($category, $page, self::MAX_PER_PAGE);
        $archive = $em->getRepository('LaFolleAgenceBundle:Post')->getAllOrderByDate();
        $categories = $em->getRepository('LaFolleAgenceBundle:Category')->getAllOrderByName();

        $total = count($posts);
        $maxPage = (int)($total / PostRepository::MAX_RESULT);
        if (($total % PostRepository::MAX_RESULT) !== 0) {
            $maxPage++;
        }
        return $this->render('front/article-categorie.html.twig', array(
            'category'      => $category,
            'maxPage'       => $maxPage,
            'posts'         => $posts,
            'page'          => $page,
            'archive'       => $archive,
            'categories'    => $categories

        ));

    }
}
