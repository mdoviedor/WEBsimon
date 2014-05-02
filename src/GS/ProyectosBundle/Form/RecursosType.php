<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecursosType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $ano = \date("Y");
        $mes = \date("M");
        $dia = \date("d");
        $builder
                ->add('nombre', 'text', array(
                    'label' => '* Nombre:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
//                ->add('descripcion', 'textarea', array(
//                    'label' => '* Nombre:',
//                    'required' => true,
//                    'attr' => array('class' => 'form-control')
//                ))
//                ->add('fecharegistro', 'date', array(
//                    'empty_value' => array('year' => $ano, 'month' => $mes, 'day' => $dia),                    
//                    'label' => 'fechaedicion:',
//                    'required' => false,
//                ))
                ->add('fechainiciopublicacion', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'label' => 'Inicio de la publicación:',
                    'required' => false,
                    'attr' => array(        
                        'data-toggle' => "tooltip",
                        'data-placement' => 'top',
                        'title' => 'Por defecto, la publicación inicia inmediatamente.',
                    ),
                    'years' => range($ano, $ano + 5),
                ))
                ->add('fechafinpublicacion', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'label' => 'Fin de la publicación:',
                    'required' => false,
                    'years' => range($ano, $ano + 5),
                ))
//                ->add('fechamodificacion')
//                ->add('vecesvisto')
                ->add('tiporecurso', 'entity', array(
                    'label' => '* Tipo de Recurso:',
                    'class' => 'GSProyectosBundle:Tiporecurso',
                    'property' => 'nombre',
                    'attr' => array('class' => 'form-control')
                ))
//                ->add('usuario')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Recursos'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_recursos';
    }

}
