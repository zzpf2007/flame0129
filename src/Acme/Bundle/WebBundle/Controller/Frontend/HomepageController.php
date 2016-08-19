<?php

/*
 * This file is part of the Sylius package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\Bundle\WebBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Acme\Component\Product\Model\Product;

/**
 * Frontend homepage controller.
 *
 */
class HomepageController extends Controller
{
  /**
   * Web front page.
   *
   * @return Response
   */
  public function mainAction()
  {
    // var_dump($this->container->has('acme.repository.product'));

    // var_dump($products = $this->getDoctrine()->getRepository('Acme\Component\Product\Model\Product')->findAll());
    return $this->render('AcmeWebBundle:Frontend/Homepage:main.html.twig');
  }

  /**
   * Product front page.
   *
   * @return Response
   */
  public function indexAction( Request $request)
  {
    // var_dump( $request );

    // $parameters = $request->get('template');
    // var_dump( $parameters );

    $repo = $this->container->get("acme.repository.product");
    // $repo = $this->container->get("qomo.repository.product");
    // $em = $this->container->get("acme.mananger.product");

    // $product = new Product();
    // $em = $this->container->get('doctrine')->getManager();
    // $em->persist($product);
    // $em->flush();

    if(!$repo) {
      echo "error!";
    }

    $product = $repo->findAll();
    // if($product){
    //   echo "product!";
    // }
    echo count($product);
    
    $limit = 10;
    $template = $request->get('template');
    $product_array = array();
    
    for ( $i = 0; $i < $limit; $i++ ) { 
      $product_array[] = $i;
    }

    return $this->render( $template, array( 'products' => $product_array ));
    // return array();
  }    
}
