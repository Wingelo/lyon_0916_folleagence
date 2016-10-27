<?php

namespace LaFolleAgenceBundle\Controller;

use LaFolleAgenceBundle\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LaFolleAgenceBundle\Entity\Post;
use LaFolleAgenceBundle\Form\PostType;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     */
    const MAX_PER_PAGE = 3;


    public function indexAction($page = 1)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('LaFolleAgenceBundle:Post')->getByPage($page, self::MAX_PER_PAGE);
        $archive = $em->getRepository('LaFolleAgenceBundle:Post')->getAllOrderByDate();
        $categories = $em->getRepository('LaFolleAgenceBundle:Category')->findAll();

        $total = count($post);
        $maxPage = (int)($total / PostRepository::MAX_RESULT);
        if (($total % PostRepository::MAX_RESULT) !== 0)
        {
            $maxPage++;
        }
        return $this->render('front/blog.html.twig', array(
            'maxPage'       => $maxPage,
            'post'          => $post,
            'page'          => $page,
            'archive'       => $archive,
            'categories'    => $categories
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
        if (($total % PostRepository::MAX_RESULT) !== 0)
        {
            $maxPage++;
        }
        return $this->render('front/blog.html.twig', array(
            'maxPage'       => $maxPage,
            'post'          => $post,
            'page'          => $page,
            'archive'       => $archive,
            'categories'    => $categories
        ));

    }

    /**
     * Creates a new Post entity.
     *
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('LaFolleAgenceBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', array('id' => $post->getId()));
        }

        return $this->render('post/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction(Post $post)
    {

        //$deleteForm = $this->createDeleteForm($post);
        $em = $this->getDoctrine()->getManager();
        $postPrecedent = $em->getRepository('LaFolleAgenceBundle:Post')->getPrecedent($post);
        $postSuivant = $em->getRepository('LaFolleAgenceBundle:Post')->getSuivant($post);
        $archive = $em->getRepository('LaFolleAgenceBundle:Post')->getAllOrderByDate();
        $categories = $em->getRepository('LaFolleAgenceBundle:Category')->findAll();

        return $this->render('front/article-blog.html.twig', array(
            'post' => $post,
            //'delete_form' => $deleteForm->createView(),
            'archive'       => $archive,
            'categories'    => $categories,
            'postPrecedent' => $postPrecedent,
            'postSuivant'   => $postSuivant
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction(Request $request, Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('LaFolleAgenceBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_edit', array('id' => $post->getId()));
        }

        return $this->render('post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a Post entity.
     *
     * @param Post $post The Post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
