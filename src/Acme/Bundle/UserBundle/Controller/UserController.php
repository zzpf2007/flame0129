<?php

namespace Acme\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ResourceController
{
    public function sendemailAction(Request $request) 
    {
        // $email_template = $request->get('_koala')['template'];
        // echo $email_template = $this->config->getTemplate('email.html');
        // $email_template = $this->config->getTemplate('email.html');
        // $message = \Swift_Message::newInstance()
        //            ->setSubject("Hello Email")
        //            ->setFrom('tr_reuters@163.com')
        //            ->setTo('zzpf@163.com')
        //            ->setBody(
        //                 $this->renderView(
        //                     $email_template, array('name' => 'Tester01')
        //                 )
        //             );

        // $this->get('mailer')->send($message);
        
        // return new Response("Email send out!");
    }
}
