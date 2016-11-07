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
        $repository = $this
            ->getDoctrine()
            ->getRepository("LaFolleAgenceBundle:Post");
        $carouselArticles = $repository->getLastSixArticles(6);

        return $this->render(
            'front/index.html.twig',
            array("carouselArticles" => $carouselArticles)
        );
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

    public function contactAction($gRecaptchaResponse, $remoteIp) {

    	$Request = $this->container->get('request_stack')->getCurrentRequest();
		$secret = '6Lf-jwoUAAAAAFPikc_ejPv0LF9NaYI1vQKa4eAf';
		$recaptcha = new \ReCaptcha\ReCaptcha($secret);
		$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
		if ($resp->isSuccess()) {

		} else {

		}
		if ($Request->getMethod() == "POST") {

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


	/**
	 * @Route("/admin")
	 */
	public function adminAction()
	{
		return new Response('<html><body>Admin page!</body></html>');
	}
}
