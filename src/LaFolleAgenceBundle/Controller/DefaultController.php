<?php

namespace LaFolleAgenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LaFolleAgenceBundle:Default:index.html.twig');
    }
}
