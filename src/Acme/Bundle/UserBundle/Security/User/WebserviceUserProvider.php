<?php
namespace Acme\Bundle\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WebserviceUserProvider implements UserProviderInterface
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $logger = $this->container->get("my_service.logger");
        $logger->info("====WebserviceUserProvider: Construct");
    }

    public function loadUserByUsername($username)
    {
        // make a call to your webservice here
        $userData = "username"; 
        // pretend it returns an array on success, false if there is no user

        $logger = $this->container->get("my_service.logger");
        $logger->info("====loadUserByUsername: " . $username);

        // $repo = $this->cnotainer->get('acme.repository.user');
        // // $user = $repo->findOneBy(array("username" => $username));
        // $user = $repo->find(1);

        $repo = $this->container->get('acme.repository.user');
        $user = $repo->findOneBy(array("username" => "test02"));

        // $logger->info("====Dump Username: " . var_dump($user));
        $logger->info("====Dump Username: " . $user->getUsername());

        if ($user) {
            return $user;
        }

        // if ($userData) {
        //     $password = 'test1234';

        //     // ...
        //     $salt = "1234";
        //     $roles = array("ROLE_USER");

        //     $user = new WebserviceUser($username, $password, $salt, $roles);
        //     $logger->info("====Build user: username: password:" . $user->getUsername() . $user->getPassword());            

        //     return $user;
        // }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Acme\Bundle\UserBundle\Security\User\WebserviceUser';
    }
}