<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduccionintelectualType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $ano = \date("Y");
        $mes = \date("M");
        $dia = \date("d");
        $builder
                ->add('archivo', 'file', array(
                    'label' => '* Archivo:',
                    'attr' => array('class' => 'form-control'),
                    'mapped' => false,
                    'required' => false
                ))
                ->add('resumen', 'textarea', array(
                    'label' => '* Resumen:',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('titulo', 'textarea', array(
                    'label' => '* Titulo:',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('palabrasclave', 'textarea', array(
                    'label' => '* Palabras Clave:',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('fechainiciopublicacion', 'date', array(
                    'required' => false,
                    'label' => 'Fecha de inicio de la publicación:',
                    'years' => range($ano, $ano + 5),
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                ))
                ->add('fechafinpublicacion', 'date', array(
                    'required' => false,
                    'label' => 'Fecha de fin de la publicación::',
                    'years' => range($ano, $ano + 5),
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                ))
                ->add('estado', 'choice', array(
                    'choices' => array(true => 'Publicado', false => 'Despublicado'),
                    'label' => '* Estado:',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('acceso', 'choice', array(
                    'label' => '* Acceso:',
                    'attr' => array('class' => 'form-control'),
                    'choices' => array(true => 'Publico', false => 'Privado'),
                ))
                ->add('destacado', 'choice', array(
                    'choices' => array(true => 'Si', false => 'No'),
                    'label' => '* Destacado:',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('tema', 'entity', array(
                    'label' => '* Tema:',
                    'attr' => array('class' => 'form-control'),
                    'class' => 'GSProyectosBundle:Tema',
                    'property' => 'titulo',
                    'query_builder' => function(\GS\ProyectosBundle\Entity\TemaRepository $er) {
                return $er->createQueryBuilder('u')
                        ->where('u.estado = true');
            }
                ))
                ->add('tipoproduccion', 'entity', array(
                    'label' => '* Tipo de producción:',
                    'attr' => array('class' => 'form-control'),
                    'class' => 'GSProyectosBundle:Tipoproduccion',
                    'property' => 'nombre'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Produccionintelectual'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_produccionintelectual';
    }

}
