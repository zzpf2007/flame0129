<?php

namespace Acme\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', 'text', array('label' => 'koala.form.user.email',))
            ->add('_password', 'password', array('label' => 'koala.form.user.password.label',));
    }

    public function getName()
    {
        return 'acme_user_security_login';
    }
}