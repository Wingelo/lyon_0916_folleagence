<?php

namespace LaFolleAgenceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

	const MAX_PER_PAGE = 3;

	public function __construct() {

	}
    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('LaFolleAgenceBundle:Category')->findAll();

        return $this->render('category/index.html.twig', array(
            'categories' => $categories,
        ));
    }

	public function filterIndexAction($category, $page = 1)
	{
		$em = $this->getDoctrine()->getManager();

		$post = $em->getRepository('LaFolleAgenceBundle:Post')->categoryGetByPage($category, $page, self::MAX_PER_PAGE);
		$archive = $em->getRepository('LaFolleAgenceBundle:Post')->findAll();
		$categories = $em->getRepository('LaFolleAgenceBundle:Category')->findAll();

		$total = count($post);
		$maxPage = (int)($total / PostRepository::MAX_RESULT);
		if (($total % PostRepository::MAX_RESULT) !== 0) {
			$maxPage++;
		}
		return $this->render('front/blog.html.twig', array(

			'maxPage' => $maxPage,
			'post' => $post,
			'page' => $page,
			'archive' => $archive,
			'categories' => $categories

		));

	}
    /**
     * Creates a new Category entity.
     *
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('LaFolleAgenceBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);

            $em->flush();

            return $this->redirectToRoute('category_show', array('id' => $category->getId()));
        }

        return $this->render('category/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     */
    public function showAction(Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('category/show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('LaFolleAgenceBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
			/* ajout gestion propre */
			/* Delete to renew link */
			$conn = $em->getConnection();

			$sql = "DELETE posts_categorys where category_id = ?";
			$stmt = $conn->prepare($sql);
			$catId = $category->getId();
			$stmt->binvValue($catId);
			$stmt->execute();

			$sql = "INSERT into posts_categorys (post_id,category_id) VALUES (?,?)";
			$catId = $category->getId();

			foreach ($category->getPosts() as $post) {
				$stmt = $conn->prepare($sql);
				$stmt->bindValue($post->id, $catId);
       			$stmt->execute();
				/*$postCategorys = new PostCategorys();
				$postCategorys->setCategoryId($catId);
				$postCategorys->setPostId($post->id);
				$em->persist($postCategorys);*/
			}
			/*fin ajout gestion propre*/
            $em->flush();

            return $this->redirectToRoute('category_edit', array('id' => $category->getId()));
        }

        return $this->render('category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Category entity.
     *
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a Category entity.
     *
     * @param Category $category The Category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
