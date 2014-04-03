<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BibliografiaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $Ahora = \date("Y");
        $builder
                ->add('autores', 'textarea', array(
                    'label' => '* Autores:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('nombre', 'text', array(
                    'label' => '* Nombre:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                
                 ->add('ubicacion', 'textarea', array(
                    'label' => 'Ubicacion:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
               
                ->add('archivo', 'file', array(
                    'label' => 'Archivo:',
                    'attr' => array('class' => 'form-control'),
                    'mapped' => false,
                    'required' => false,
                ))
                ->add('traduccion', 'choice', array(
                    'label' => '* Traducción:',
                    'choices' => array(false => 'No ', true => ' Si'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true))
                
                ->add('fechaedicion', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'years' => range(1980, $Ahora),
                    'label' => 'fechaedicion:',
                    'required' => false,
                ))
                ->add('editorial', 'textarea', array(
                    'label' => 'Editorial:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('resumen', 'textarea', array(
                    'label' => 'Resumen:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('recomendacionesuso', 'textarea', array(
                    'label' => 'Recomendaciones de uso:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('tablacontenido', 'textarea', array(
                    'label' => 'Tabla de contenido:',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('palabrasclave', 'textarea', array(
                    'label' => '* Palabras clave:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('areainvestigacion', 'entity', array(
                    'label' => '* Area de investigación:',
                    'class' => 'GSProyectosBundle:Areainvestigacion',
                    'property' => 'nombre',                   
                    'attr' => array('class' => 'form-control')
                ))
                ->add('categoria', 'entity', array(
                    'label' => '* Categoría:',
                    'class' => 'GSProyectosBundle:Categoriabibliografia',
                    'property' => 'nombre',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('tipoelementobibliografico', 'entity', array(
                    'label' => '* Tipo de elemento bibliografico:',
                    'class' => 'GSProyectosBundle:Tipoelementobibliografico',
                    'property' => 'nombre',
                    'attr' => array('class' => 'form-control')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Bibliografia'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_bibliografia';
    }

}
