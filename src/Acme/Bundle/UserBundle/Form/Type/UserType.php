<?php

namespace Acme\Bundle\UserBundle\Form\Type;

use Acme\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', 'password', array(
                'label' => 'acme.form.user.password.label',
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'acme.form.user.enabled',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // $resolver
        //     ->setDefaults(array(
        //         'data_class' => $this->dataClass,
        //         'validation_groups' => function (FormInterface $form) {
        //             $data = $form->getData();
        //             if ($data && !$data->getId()) {
        //                 $this->validationGroups[] = 'sylius_user_create';
        //             }

        //             return $this->validationGroups;
        //         },
        //     ))
        // ;
        $resolver
            ->setDefaults(array(
                'data_class' => $this->dataClass
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'acme_user';
    }
}
