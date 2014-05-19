<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeminarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $ano = \date("Y");
        $builder
                ->add('titulo', 'text', array(
                    'label' => '* Título:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('acceso', 'choice', array(
                    'label' => '* Acceso:',
                    'required' => true,
                    'choices' => array(true => 'Publico', false => 'Privado'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('destacado', 'choice', array(
                    'label' => '* Destacado:',
                    'required' => true,
                    'choices' => array(true => 'Si', false => 'No'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('estado', 'choice', array(
                    'label' => '* Estado:',
                    'required' => true,
                    'choices' => array(true => 'Publico', false => 'Privado'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('fecha', 'date', array(
                    'label' => '* Fecha:',
                    'years' => range($ano, $ano + 5),
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'required' => true,
                  
                ))
//                ->add('descripcion', 'textarea', array(
//                    'label' => '* Proposito general de la lectura:',
//                    'required' => true,
//                    'attr' => array('class' => 'form-control')
//                ))
//                ->add('fecharegistro', 'textarea', array(
//                    'label' => '* Proposito general de la lectura:',
//                    'required' => true,
//                    'attr' => array('class' => 'form-control')
//                ))
//                ->add('fechamodificacion', 'textarea', array(
//                    'label' => '* Proposito general de la lectura:',
//                    'required' => true,
//                    'attr' => array('class' => 'form-control')
//                ))
                ->add('fechainiciopublicacion', 'date', array(
                    'label' => 'Fecha de inicio de la puclicación:',
                    'required' => false,
                    'years' => range($ano, $ano + 5),
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                        //'attr' => array('class' => 'form-control')
                ))
                ->add('fechafinpublicacion', 'date', array(
                    'label' => 'Fecha de fin de la publicación:',
                    'required' => false,
                    'years' => range($ano, $ano + 5),
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                        //'attr' => array('class' => 'form-control')
                ))
//                ->add('vecesvisto', 'textarea', array(
//                    'label' => '* Proposito general de la lectura:',
//                    'required' => true,
//                    'attr' => array('class' => 'form-control')
//                ))
                ->add('mostrattitulo', 'choice', array(
                    'label' => '* Mostrar título:',
                    'required' => true,
                    'choices' => array(true => 'Si', false => 'No'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('mostrarautor', 'choice', array(
                    'label' => '* Mostrar autor:',
                    'required' => true,
                    'choices' => array(true => 'Si', false => 'No'),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('mostrarcategoria', 'choice', array(
                    'label' => '* Mostrar categoría:',
                    'choices' => array(true => 'Si', false => 'No'),
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('mostrarfechacracion', 'choice', array(
                    'label' => '* Mostrar fecha de creación:',
                    'choices' => array(true => 'Si', false => 'No'),
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('mostrarfechapublicacion', 'choice', array(
                    'label' => '* Mostrar fecha de publicación:',
                    'choices' => array(true => 'Si', false => 'No'),
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('mostrarfechamodificacion', 'choice', array(
                    'label' => '* Mostrar fecha de modificación:',
                    'choices' => array(true => 'Si', false => 'No'),
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('prioridad', 'entity', array(
                    'label' => '* Prioridad:',
                    'class' => 'GSProyectosBundle:Prioridad',
                    'property' => 'nombre',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
//            ->add('usuario')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Seminario'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_seminario';
    }

}
