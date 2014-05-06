<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TemaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $ano = \date("Y");
        $mes = \date("M");
        $dia = \date("d");
        $builder
                ->add('titulo', 'textarea', array(
                    'label' => '* Titulo:',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('tiempoestimado', 'number', array(
                    'label' => '* Tiempo estimado para el desarrollo del proyecto (Meses):',
                    'attr' => array('class' => 'form-control',
                    ),
                ))
                ->add('fechainiciopublicacion', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'required' => false,
                    'label' => 'Fecha de inicio de la publicación:',
                    'years' => range($ano, $ano + 5),
                ))
                ->add('fechafinpublicacion', 'date', array(
                    'required' => false,
                    'label' => 'Fecha de fin de la publicación:',
                    'years' => range($ano, $ano + 5),
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Tema'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_tema';
    }

}
