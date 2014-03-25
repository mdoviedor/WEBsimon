<?php

namespace GS\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => false,
                    'first_options' => array(
                        'label' => '* Contraseña:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Contraseña:',
                        'attr' => array('class' => 'form-control'))))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\UsuarioBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_usuariobundle_user';
    }

}
