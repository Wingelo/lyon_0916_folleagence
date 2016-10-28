<?php

namespace LaFolleAgenceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('front/index.html.twig');
    }

    public function mentionslegalesAction() {
        return $this->render('front/mentionslegales.html.twig');
    }

    public function aproposAction() {
        return $this->render('front/a-propos.html.twig');
    }

    public function prestationsAction() {
        return $this->render('front/prestations.html.twig');
    }

    public function referencesEtProjetsAction() {
        return $this->render('front/references-et-projets.html.twig');
    }

    public function contactAction() {

    	$Request = $this->container->get('request_stack')->getCurrentRequest();
		if ($Request->getMethod() == "POST") {
			//$Subject = $Request->get("Subject");
			$email = $Request->get("email");
			$message = $Request->get("message");
			$last_name = $Request->get("last_name");
			$first_name = $Request->get("first_name");
			$tel = $Request->get("tel");

			$mailer = $this->container->get('mailer');
			$transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
				->setUsername('etudiants.wildcodeschool@gmail.com')
				->setPassword('jecode4lyon');
			$mailer = \Swift_Mailer::newInstance($transport);
			$message = \Swift_Message::newInstance('Test')
				->setSubject("Un nouveau message sur La Folle Agence")
				->setFrom($email)
				->setTo('etudiants.wildcodeschool@gmail.com')
				->setContentType("text/html")
				->setBody('email : ' . $email . '<br />' . 'Prénom : ' . $first_name . '<br />' . 'Nom : ' . $last_name . '<br />' .
					'N° de téléphone : ' . $tel . '<br /><br />' . $message);
			$this->get('mailer')->send($message);

		}
		return $this->render('front/contact.html.twig');
    }

    public function blogAction() {
        return $this->render('front/blog.html.twig');
    }

    public function articleBlogAction() {

    	$Request = $this->container->get('request_stack')->getCurrentRequest();
		if ($Request->getMethod() == "POST") {
			//$Subject = $Request->get("Subject");
			$email = $Request->get("email");
			$message = $Request->get("message");
			$last_name = $Request->get("last_name");
			$first_name = $Request->get("first_name");
			$tel = $Request->get("tel");

			$mailer = $this->container->get('mailer');
			$transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
				->setUsername('etudiants.wildcodeschool@gmail.com')
				->setPassword('jecode4lyon');
			$mailer = \Swift_Mailer::newInstance($transport);
			$message = \Swift_Message::newInstance('Test')
				->setSubject("Un nouveau message sur La Folle Agence")
				->setFrom($email)
				->setTo('etudiants.wildcodeschool@gmail.com')
				->setContentType("text/html")
				->setBody('email : ' . $email . '<br />' . 'Prénom : ' . $first_name . '<br />' . 'Nom : ' . $last_name . '<br />' .
					'N° de téléphone : ' . $tel . '<br /><br />' . $message);
			$this->get('mailer')->send($message);
        return $this->render('front/article-blog.html.twig');
    }

	/**
	 * @Route("/admin")
	 */
	public function adminAction()
	{
		return new Response('<html><body>Admin page!</body></html>');
	}
}
