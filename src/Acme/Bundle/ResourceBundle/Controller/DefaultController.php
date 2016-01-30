<?php

namespace Acme\Bundle\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeResourceBundle:Default:index.html.twig');
    }
}
