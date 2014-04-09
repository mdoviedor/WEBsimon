<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('primernombre', 'text', array(
                    'label' => 'Primer Nombre:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('segundonombre', 'text', array(
                    'label' => 'Segundo Nombre:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('primerapellido', 'text', array(
                    'label' => 'Primer Apellido:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('segundoapellido', 'text', array(
                    'label' => 'Segundo Apellido:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('telefonofijo', 'text', array(
                    'label' => 'Teléfono Fijo:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('telefonocelular', 'text', array(
                    'label' => 'Teléfono Celular:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('archivo', 'file', array(
                    'label' => 'Archivo:',
                    'attr' => array('class' => 'form-control input-sm'),
                    'mapped' => false,
                    'required' => false,
                ))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => false,
                    'mapped'=> false,
                    'first_options' => array(
                        'label' => 'Contraseña:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => 'Repita Contraseña:',
                        'attr' => array('class' => 'form-control'))))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_usuario';
    }

}
