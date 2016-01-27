<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;
use Acme\Bundle\IOTBundle\Entity\Device;
use Acme\Bundle\IOTBundle\Entity\Channel;
use Acme\Bundle\MySysBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:
 *
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadPosts($manager);
        $this->loadDevice($manager);
        $this->loadCategory($manager);
    }

    private function loadCategory(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setPid(0);
        $category1->setName('新闻');
        $category1->setCorder(1);

        $manager->persist($category1);
        $manager->flush();

        $category2 = new Category();
        $category2->setPid($category1->getId());
        $category2->setName('中国新闻');
        $category2->setCorder(1);

        $manager->persist($category2);
        $manager->flush();

        $category3 = new Category();
        $category3->setPid($category1->getId());
        $category3->setName('美国新闻');
        $category3->setCorder(2);

        $manager->persist($category3);
        $manager->flush();

        $category4 = new Category();
        $category4->setPid(0);
        $category4->setName('娱乐');
        $category4->setCorder(2);

        $manager->persist($category4);
        $manager->flush();

        $category5 = new Category();
        $category5->setPid($category4->getId());
        $category5->setName('中国娱乐');
        $category5->setCorder(1);

        $manager->persist($category5);
        $manager->flush();

        $category = new Category();
        $category->setPid($category4->getId());
        $category->setName('美国娱乐');
        $category->setCorder(2);

        $manager->persist($category);
        $manager->flush();
    }

    private function loadDevice(ObjectManager $manager)
    {
        $device = new Device();
        $device->setIotname("Smart01测试");
        $device->setIotid("Smart01");
        $device->setSlug($this->container->get('slugger')->slugify($device->getIotname()));

        $channel = new Channel();
        $channel->setDevice($device);
        $channel->setIotname('channel01');
        $channel->setIotid('channel01');
        $channel->setSlug($this->container->get('slugger')->slugify($channel->getIotname()));        

        $manager->persist($device);
        $manager->persist($channel);
        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $johnUser = new User();
        $johnUser->setUsername('john_user');
        $johnUser->setEmail('john_user@symfony.com');
        $encodedPassword = $passwordEncoder->encodePassword($johnUser, 'kitten');
        $johnUser->setPassword($encodedPassword);
        $manager->persist($johnUser);

        $annaAdmin = new User();
        $annaAdmin->setUsername('anna_admin');
        $annaAdmin->setEmail('anna_admin@symfony.com');
        $annaAdmin->setRoles(array('ROLE_ADMIN'));
        $encodedPassword = $passwordEncoder->encodePassword($annaAdmin, 'kitten');
        $annaAdmin->setPassword($encodedPassword);
        $manager->persist($annaAdmin);

        $manager->flush();
    }

    private function loadPosts(ObjectManager $manager)
    {
        foreach (range(1, 30) as $i) {
            $post = new Post();

            $post->setTitle($this->getRandomPostTitle());
            $post->setSummary($this->getRandomPostSummary());
            $post->setSlug($this->container->get('slugger')->slugify($post->getTitle()));
            $post->setContent($this->getPostContent());
            $post->setAuthorEmail('anna_admin@symfony.com');
            $post->setPublishedAt(new \DateTime('now - '.$i.'days'));

            foreach (range(1, 5) as $j) {
                $comment = new Comment();

                $comment->setAuthorEmail('john_user@symfony.com');
                $comment->setPublishedAt(new \DateTime('now + '.($i + $j).'seconds'));
                $comment->setContent($this->getRandomCommentContent());
                $comment->setPost($post);

                $manager->persist($comment);
                $post->addComment($comment);
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function getPostContent()
    {
        return <<<MARKDOWN
Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor
incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in
reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
deserunt mollit anim id est laborum.

  * Ut enim ad minim veniam
  * Quis nostrud exercitation *ullamco laboris*
  * Nisi ut aliquip ex ea commodo consequat

Praesent id fermentum lorem. Ut est lorem, fringilla at accumsan nec, euismod at
nunc. Aenean mattis sollicitudin mattis. Nullam pulvinar vestibulum bibendum.
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
himenaeos. Fusce nulla purus, gravida ac interdum ut, blandit eget ex. Duis a
luctus dolor.

Integer auctor massa maximus nulla scelerisque accumsan. *Aliquam ac malesuada*
ex. Pellentesque tortor magna, vulputate eu vulputate ut, venenatis ac lectus.
Praesent ut lacinia sem. Mauris a lectus eget felis mollis feugiat. Quisque
efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue
nulla vitae est.

Ut posuere aliquet tincidunt. Aliquam erat volutpat. **Class aptent taciti**
sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi
arcu orci, gravida eget aliquam eu, suscipit et ante. Morbi vulputate metus vel
ipsum finibus, ut dapibus massa feugiat. Vestibulum vel lobortis libero. Sed
tincidunt tellus et viverra scelerisque. Pellentesque tincidunt cursus felis.
Sed in egestas erat.

Aliquam pulvinar interdum massa, vel ullamcorper ante consectetur eu. Vestibulum
lacinia ac enim vel placerat. Integer pulvinar magna nec dui malesuada, nec
congue nisl dictum. Donec mollis nisl tortor, at congue erat consequat a. Nam
tempus elit porta, blandit elit vel, viverra lorem. Sed sit amet tellus
tincidunt, faucibus nisl in, aliquet libero.
MARKDOWN;
    }

    private function getPhrases()
    {
        return array(
            'Lorem ipsum dolor sit amet consectetur adipiscing elit',
            'Pellentesque vitae velit ex',
            'Mauris dapibus risus quis suscipit vulputate',
            'Eros diam egestas libero eu vulputate risus',
            'In hac habitasse platea dictumst',
            'Morbi tempus commodo mattis',
            'Ut suscipit posuere justo at vulputate',
            'Ut eleifend mauris et risus ultrices egestas',
            'Aliquam sodales odio id eleifend tristique',
            'Urna nisl sollicitudin id varius orci quam id turpis',
            'Nulla porta lobortis ligula vel egestas',
            'Curabitur aliquam euismod dolor non ornare',
            'Sed varius a risus eget aliquam',
            'Nunc viverra elit ac laoreet suscipit',
            'Pellentesque et sapien pulvinar consectetur',
        );
    }

    private function getRandomPostTitle()
    {
        $titles = $this->getPhrases();

        return $titles[array_rand($titles)];
    }

    private function getRandomPostSummary()
    {
        $phrases = $this->getPhrases();

        $numPhrases = rand(6, 12);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases-1));
    }

    private function getRandomCommentContent()
    {
        $phrases = $this->getPhrases();

        $numPhrases = rand(2, 15);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases-1));
    }
}
