<?php

namespace Acme\Bundle\WebBundle\Controller\Frontend; 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

class ProductController extends FOSRestController
{
    public function getBlogsAction( Request $request )
    {
        // var_dump( $request );
        $template = $request->get('_koala')['template'];
        $blogs = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();

        // echo count( $blogs );

        $data = array( 'blogs' => $blogs ); // get data, in this case list of users.

        $category = "Category 1";
        $templateData = array('category' => $category);

        $view = $this->view( $data, 200 )
            ->setTemplate( $template )
            ->setTemplateVar( 'blogs' )
            ->setTemplateData( $templateData )
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