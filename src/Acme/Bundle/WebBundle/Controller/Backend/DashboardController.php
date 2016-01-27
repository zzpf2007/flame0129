<?php

/*
 *
 *
 */

namespace Acme\Bundle\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Backend dashboard controller.
 *
 */
class DashboardController extends Controller
{
    /**
     * Backend dashboard display action.
     */
    public function mainAction()
    {
        return $this->render('AcmeWebBundle:Backend/Dashboard:main.html.twig');
    }
}
