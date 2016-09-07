<?php

namespace Acme\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $template = $request->attributes->get('_koala[template]', 'AcmeUserBundle:Security:login.html.twig', true);
        $formType = $request->attributes->get('_koala[form]', 'acme_user_security_login', true);
        $form = $this->get('form.factory')->createNamed('', $formType);

        // \Doctrine\Common\Util\Debug::dump($this->get('acme.repository.user')->find(1));
        // $repo = $this->get('acme.user_provider.name')->findUser("test02");
        // echo $repo->getUsername();

        

        return $this->renderLogin($template, array(
                'form'          => $form->createView(),
                'last_username' => $lastUsername,
                'error'         => $error,
            ));
    }

    /**
     * Login check action. This action should never be called.
     */
    public function checkAction(Request $request)
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    /**
     * Logout action. This action should never be called.
     */
    public function logoutAction(Request $request)
    {
        throw new \RuntimeException('You must configure the logout path to be handled by the firewall.');
    }

    protected function renderLogin($template, array $data)
    {
        return $this->render($template, $data);
    }
}