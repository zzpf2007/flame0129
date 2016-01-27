<?php

namespace Acme\Bundle\IOTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeIOTBundle:Default:index.html.twig');
    }
}
