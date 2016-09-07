<?php
// Acme/Bundle/WebBundle/Menu/Builder.php
namespace Acme\Bundle\WebBundle\Menu;

use Knp\Menu\FactoryInterface;
use Acme\Component\Cart\Provider\CartProviderInterface;
// use Symfony\Component\DependencyInjection\ContainerAwareInterface;
// use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Translation\TranslatorInterface;

// class Builder implements ContainerAwareInterface
class FrontendMenuBuilder extends MenuBuilder
{    
    public function __construct(FactoryInterface $factory, 
                                AuthorizationCheckerInterface $authorizationChecker,
                                TranslatorInterface $translator,
                                EventDispatcherInterface $eventDispatcher,
                                CartProviderInterface $cartProvider
                                )
    {
        parent::__construct($factory, $authorizationChecker, $translator, $eventDispatcher);
        $this->cartProvider = $cartProvider;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'acme_homepage_test'));

        // access services from the container!
        // $em = $this->container->get('doctrine')->getManager();
        // // findMostRecent and Blog are just imaginary examples
        // $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

        $cartTotals = $this->cartProvider->getCart();

        $menu->addChild('Cart', array('route' => 'acme_homepage_test'))
             ->setLabel(sprintf('View cart (%s) $%s', $cartTotals['items'], $cartTotals['total']));

        $menu->addChild('Latest Post', array(
            'route' => 'acme_homepage_test',
            'routeParameters' => array('id' => '1')
        ));

        // create another menu item
        $menu->addChild('About Me', array(
                            'route' => 'acme_homepage_test',
                            'labelAttributes' => array('icon' => 'icon-user icon-large', 'iconOnly' => false)
                            )
                        );
        
        // you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'acme_homepage_test'));

        if ($this->authorizationChecker->isGranted("ROLE_ADMINISTRATION_ACCESS")) {
            $routeParams = array(
                                'route' => 'acme_homepage_test',
                                'linkAttributes' => array('title' => 'Administrator')
                                );
            $menu->addChild('Administration', $routeParams); 
        }

        // ... add more children

        return $menu;
    }
}