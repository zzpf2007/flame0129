<?php

namespace Acme\Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

// class ProductController extends Controller
class ProductController extends ResourceController
{
    public function indexAction(Request $request)
    {
      // var_dump( $this->get('acme.controller.product') );

      // var_dump($this->container->getParameter('acme.controller.configuration_factory.class'));
      // var_dump($this->container->has('acme.expression_language'));
      // $test01 = $this->get('acme.controller.configuration_factory');
      // $test01->createConfiguration('acme', 'product', 'acme');
      return $this->render('AcmeProductBundle:Default:index.html.twig');
    }
}
