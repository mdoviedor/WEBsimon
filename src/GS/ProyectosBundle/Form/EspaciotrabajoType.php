<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EspaciotrabajoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'label' => '* Nombre del espcio de trabajo: ',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('url', 'url', array(
                    'label' => '* Enlace:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Espaciotrabajo'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_espaciotrabajo';
    }

}
