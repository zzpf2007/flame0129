<?php

namespace Acme\Bundle\MySysBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
    /**
     * @Route("/access", name="mysys_access")
     * @Template()
     */
    public function accessAction()
    {        
        $name = "test controller";

        // if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        if ( $this->get('security.authorization_checker')->isGranted('ROLE_USER') ) {
            // throw $this->createAccessDeniedException();
            $name = "test controller ROLE_USER";
        }

        if ( $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') ) {
            // throw $this->createAccessDeniedException();
            $name = "test controller ROLE_ADMIN";
        }        
        
        return array( "name" => $name );
    }

  /**
   * @Template()
   */
  public function indexAction()
  {
    $name = "Test Controller";
    $em = $this->getDoctrine()->getManager();
    // $repo = $em->getRepository('AcmeMySysBundle:Category')->findAllOrderedByPid();

    // $categories = $repo->findAllOrderedByPid();
    // $categories = $repo->findAll();

    $categories = $em->getRepository('AcmeMySysBundle:Category')->findAllOrderedByPid();

    // var_dump($categories);
    $catArray = $this->buildTree( $categories, 0 );
    echo 'times||';
    //var_dump($catArray);

    // foreach ($catArray as $key => $value) {
    //   // echo '</br>';
    //   // var_dump($value);
    //   // echo '</br>';

    // }


    // foreach ($categories as $category) {
    //   // echo $category['id'] . '-' . $category['pid'];
    //   // echo '</br>';
    //   $pidArray = explode( '-', $category['pid'] );
    //   $name = $category['name'];
    //   // $catPid = $pidArray[0];      
    //   $itemArray = $catArray;
    //   var_dump($itemArray);
    //   foreach( $pidArray as $pid ) {
    //     // if ( isset($catArray[ $catPid ])) {
    //     //   $catArray[ $catPid ]['son'][] = &$
    //     // } else {

    //     // }
    //     // print_r( $itemArray );
    //     echo $category['pid'];
    //     echo '</br>';
    //     echo $pid;
    //     echo '</br>';
    //     // $itemArray = $this->buildTree( $itemArray, $pid, $category['name'] );
    //     if ( array_key_exists( $pid, $itemArray) ) {
    //       $itemArray = $itemArray[$pid];
    //       echo 'continue: </br>';
    //     } else {
    //       $itemArray[$pid] = $name;
    //       echo 'Add: ' . $name . '</br>';
    //     }
    //   }

    //   $catArray[] = $itemArray;
    //   unset( $itemArray );
    // }

    // var_dump($catArray);

    // foreach ($catArray as $key => $category) {
    //   // var_dump( $category );
    // }

    return array('name' => $name);
  }

  private function buildTree( $items, $pid )
  {
    // if( !array_key_exists( $pid, $itemArray ) ) {
    //   $itemArray[$pid] = $name;
    //   echo 'Add' . $name;
    //   echo '</br>';
    // }

    // return $itemArray;

    $tree = array();
    foreach ($items as $k => $v) {
      if( $v['pid'] === $pid ) {
        // echo $pid . '-' . $v['id'] . '</br>';
        $v['children'] = $this->buildTree( $items, $v['id']);
        $tree[] = $v;
      }
    }
    return $tree;

    // $tree = array();
    // foreach ($items as $item){
    //   echo $item['pid'];
    //   if (isset($items[$item['pid']])) {
    //     $items[$item['pid']]['son'][] = &$items[$item['id']];
    //   } else {
    //     $tree[] = &$items[$item['id']];
    //   }
    //   var_dump($tree);
    // }
    // return $tree;
  }
}
