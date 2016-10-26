<?php

namespace LaFolleAgenceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LaFolleAgenceBundle\Entity\Comment;
use LaFolleAgenceBundle\Form\CommentType;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{
    /**
     * Lists all Comment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('LaFolleAgenceBundle:Comment')->findAll();

        return $this->render('comment/index.html.twig', array(
            'comments' => $comments,
        ));
    }

    /**
     * Creates a new Comment entity.
     *
     */
    public function newAction(Request $request)
    {
        $comment = new Comment();

        $form = $this->createFormBuilder('LaFolleAgenceBundle\Form\CommentType', $comment)
            ->add('author', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('authorEmail', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('date', 'Symfony\Component\Form\Extension\Core\Type\DateType')
            ->add('title','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('content','Symfony\Component\Form\Extension\Core\Type\TextArea')
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\Submit', array('label' => 'Commenter l\'article'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comment_show', array('id' => $comment->getId()));
        }

        return $this->render('comment/new.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comment entity.
     *
     */
    public function showAction(Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return $this->render('comment/show.html.twig', array(
            'comment' => $comment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comment entity.
     *
     */
    public function editAction(Request $request, Comment $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('LaFolleAgenceBundle\Form\CommentType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comment_edit', array('id' => $comment->getId()));
        }

        return $this->render('comment/edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comment entity.
     *
     */
    public function deleteAction(Request $request, Comment $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comment_index');
    }

    /**
     * Creates a form to delete a Comment entity.
     *
     * @param Comment $comment The Comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comment $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comment_delete', array('id' => $comment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
