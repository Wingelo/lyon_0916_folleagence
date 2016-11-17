<?php

namespace LaFolleAgenceBundle\Controller;

use LaFolleAgenceBundle\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LaFolleAgenceBundle\Entity\Post;
use LaFolleAgenceBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use ReCaptcha\ReCaptcha;

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
    const MAX_PER_PAGE = 4;

    public function indexAction($page = 1)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('LaFolleAgenceBundle:Post')->getByPage($page, self::MAX_PER_PAGE);
        $archive = $em->getRepository('LaFolleAgenceBundle:Post')->getAllOrderByDate();
        $categories = $em->getRepository('LaFolleAgenceBundle:Category')->getAllOrderByName();

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
     * @param Post $post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function showAction(Post $post, Request $request)
    {
		$recaptcha = new ReCaptcha($this->container->getParameter('captcha_secret_private2'));
		$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

        $comment = new Comment();
        $comment->setPost($post);
        $formComment = $this->createFormBuilder($comment)
            ->add('author', TextType::class, array('label' => 'Prénom et Nom'))
            ->add('authorEmail', TextType::class, array('label' => 'E-mail'))
            ->add('title', TextType::class, array('label' => 'Titre du commentaire'))
            ->add('content', TextareaType::class, array('label' => 'Message'))
            ->getForm();

        $formComment->handleRequest($request);
		if ($resp->isSuccess()) {
        	if ($formComment->isSubmitted() && $formComment->isValid()) {
            	$em = $this->getDoctrine()->getManager();
            	$em->persist($comment);
            	$em->flush();

				// Do something if the submit wasn't valid ! Use the message to show something

				$name = $comment->getAuthor();
				$emailName = $comment->getAuthorEmail();
				$title = $comment->getTitle();
				$commentContent = $comment->getContent();
				$url = $post->getLink();
				$article = $post->getTitle();

				$mailTo = $this->container->getParameter('mailer_to');
				$mailFrom = $this->container->getParameter('mailer_from');
				$message = \Swift_Message::newInstance('Test')
					->setSubject("Un nouveau commentaire sur La Folle Agence")
					->setTo($mailTo)
					->setFrom($mailFrom)
					->setContentType("text/html")
					->setBody(
						$this->renderView(
							'Swift/message-commentaire.html.twig',
							array(
							'name' => $name,
							'emailname' => $emailName,
							'title'=> $title,
							'commentContent' => $commentContent,
							'url' => $url,
							'article' => $article
							)
						)
					);
				$this->get('mailer')->send($message);

				return $this->redirectToRoute('lafolleagence_article_blog', array('link' => $post->getLink()));
			}
        }

        $em = $this->getDoctrine()->getManager();
        $archive = $em->getRepository('LaFolleAgenceBundle:Post')->getAllOrderByDate();
        $categories = $em->getRepository('LaFolleAgenceBundle:Category')->getAllOrderByName();
        $comments = $post->getComments();
        return $this->render('front/article-blog.html.twig', array(
            'post'          => $post,
            'archive'       => $archive,
            'categories'    => $categories,
            'comments'      => $comments,
            'formComment'   => $formComment->createView(),
			'key'			=> $this->container->getParameter('captcha_secret_public1')
        ));
    }
}
