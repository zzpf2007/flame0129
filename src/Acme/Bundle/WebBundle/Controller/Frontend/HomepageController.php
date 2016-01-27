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
