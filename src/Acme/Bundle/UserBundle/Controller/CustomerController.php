<?php

namespace Acme\Bundle\UserBundle\Controller; 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class CustomerController extends FOSRestController
{
    public function indexAction( Request $request )
    {
        $template = $request->get('_koala')['template'];
        $data = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        $view = $this->view( $data, 200 )
            ->setTemplate( $template )
            ->setTemplateVar( 'customers' )
        ;

        return $this->handleView($view);
    }

    public function redirectAction()
    {
        $view = $this->redirectView($this->generateUrl('some_route'), 301);
        // or
        $view = $this->routeRedirectView('some_route', array(), 301);

        return $this->handleView($view);
    }
}