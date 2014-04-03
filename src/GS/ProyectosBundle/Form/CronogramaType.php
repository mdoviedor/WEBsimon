<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CronogramaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('hito', 'textarea', array(
                    'required' => true,
                    'label' => '* Hito:',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    
                ))
                ->add('fecha', 'date', array(
                    'label' => '* Fecha de culminación:'
                ))
                ->add('fecharegistro', 'date', array(
                    'label' => '* Fecha de inicio:'
                ))
                ->add('descripcion', 'textarea', array(
                    'label' => '* Descripción:',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => true,
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Cronograma'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_cronograma';
    }

}
