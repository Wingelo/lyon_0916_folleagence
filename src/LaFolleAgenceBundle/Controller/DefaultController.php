<?php

namespace LaFolleAgenceBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReCaptcha\ReCaptcha;
use Symfony\Component\HttpFoundation\Request;

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

    public function contactAction(Request $request)
	{
		$recaptcha = new ReCaptcha($this->container->getParameter('captcha_secret_private1'));
		$resp = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

		if ($resp->isSuccess()) {


				$email = $request->get("email");
				$message = $request->get("message");
				$last_name = $request->get("last_name");
				$first_name = $request->get("first_name");
				$tel = $request->get("tel");

				$mailTo = $this->container->getParameter('mailer_to');
				$mailFrom = $this->container->getParameter('mailer_from');
				$message = \Swift_Message::newInstance('Test')
					->setSubject("Un nouveau message sur La Folle Agence")
					->setTo($mailTo)
					->setfrom($mailFrom)
					->setContentType("text/html")
					->setBody('email : ' . $email . '<br />' . 'Prénom : ' . $first_name . '<br />' . 'Nom : ' . $last_name . '<br />' .
						'N° de téléphone : ' . $tel . '<br /><br />' . $message);
				$this->get('mailer')->send($message);

			}
			return $this->render('front/contact.html.twig', array(
				'key' => $this->container->getParameter('captcha_secret_public1')
			));
	}
}
