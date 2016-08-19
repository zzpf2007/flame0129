<?php

namespace Acme\Bundle\UserBundle\Form\Type;

use Acme\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserRegistrationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            // ->add('plainPassword', 'repeated', 
            //         array(
            //             'type'            => 'password',
            //             'first_options'   => array('label' => 'acme.form.user.password.label'),
            //             'second_options'  => array('label' => 'acme.form.user.password.confirmation'),
            //             'invalid_message' => 'acme.user.plainPassword.mismatch',
            // ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'acme_user_registration';
    }
}
