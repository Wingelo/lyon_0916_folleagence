<?php

namespace LaFolleAgenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('front/contact.html.twig');
    }

    public function blogAction() {
        return $this->render('front/blog.html.twig');
    }

    public function articleBlogAction() {
        return $this->render('front/article-blog.html.twig');
    }
}
