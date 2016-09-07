<?php

namespace Acme\Bundle\RbacBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeRbacBundle:Default:index.html.twig');
    }
}
