<?php

namespace GS\UsuarioBundle\Form;

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
                ->add('numerodocumentoidentidad', 'repeated', array(
                    'type' => 'text',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => true,
                    'first_options' => array(
                        'label' => '* Documento Identidad:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Documento Identidad:',
                        'attr' => array('class' => 'form-control'))))
                ->add('primernombre', 'text', array(
                    'label' => '* Primer Nombre:',
                    'attr' => array('class' => 'form-control')))
                ->add('segundonombre', 'text', array(
                    'label' => 'Segundo Nombre:',
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('primerapellido', 'text', array(
                    'label' => '* Primer Apellido:',
                    'attr' => array('class' => 'form-control')))
                ->add('segundoapellido', 'text', array(
                    'label' => '* Segundo Apellido:',
                    'attr' => array('class' => 'form-control')))
                ->add('telefonofijo', 'text', array(
                    'label' => 'Teléfono Fijo:',
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('telefonocelular', 'text', array(
                    'label' => 'Télefono Celular',
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                //  ->add('fecharegistro')
                //     ->add('user')
                ->add('tipodocumentoidentidad', 'entity', array(
                    'class' => 'GSUsuarioBundle:Tipodocumentoidentidad',
                    'property' => 'nombre',
                    'label' => '* Tipo Documento Identidad:',
                    'attr' => array('class' => 'form-control')))
                ->add('tipousuario', 'entity', array(
                    'class' => 'GSUsuarioBundle:Tipousuario',
                    'property' => 'nombre',
                    'label' => '* Tipo de Usuario:',
                    'attr' => array('class' => 'form-control')))
                ->add('email', 'repeated', array(
                    'mapped' => false,
                    'type' => 'email',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => true,
                    'first_options' => array(
                        'label' => '* Correo Electrónico:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Correo Electrónico:',
                        'attr' => array('class' => 'form-control'))))
                ->add('enable', 'choice', array(
                    'mapped' => false,
                    'choices' => array(true => 'Habilitado', false => 'No Habilitado'),
                    'required' => true,
                    'label' => '* Estado:',
                    'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_usuariobundle_usuario';
    }

}
