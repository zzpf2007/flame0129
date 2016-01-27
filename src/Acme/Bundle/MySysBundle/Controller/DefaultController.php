<?php

namespace Acme\Bundle\MySysBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeMySysBundle:Default:index.html.twig');
    }
}
