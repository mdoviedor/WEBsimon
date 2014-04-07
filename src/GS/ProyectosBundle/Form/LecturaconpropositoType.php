<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LecturaconpropositoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('propositogeneral', 'textarea', array(
                    'label' => '* Proposito general de la lectura:',
                    'required' => true,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('titulosubcapitulos', 'textarea', array(
                    'label' => '1. ¿Cuales son los títulos de los subcapítulos?',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('resumen', 'choice', array(
                    'label' => '* 2. Existe un resumen al principio o al final de los capitulos ?',
                    'choices' => array(false => 'No ', true => ' Si'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true))
                ->add('preguntasfinalcapitulo', 'choice', array(
                    'label' => '* 3. Existe preguntas al final de los capítulos ?',
                    'choices' => array(false => 'No ', true => ' Si'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true))
                ->add('glosario', 'choice', array(
                    'label' => '* 4. Existe un glosario o una lista de vocabulario al final del texto ?',
                    'choices' => array(false => 'No ', true => ' Si'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true))
                ->add('secciones', 'textarea', array(
                    'label' => '5. Cuales son las secciones que componen el texto?',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('descripcionilustraciones', 'textarea', array(
                    'label' => '6. Describa las ilustraciones, graficas, esquemas, tablas o cuadros que descubrió en el texto',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('resumenlectura', 'textarea', array(
                    'label' => '7. Resuma en una o dos frases de que tratará la lectura',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('lecturaproposito', 'textarea', array(
                    'label' => 'Lea sección por sección centrando la atención sobre posibles respuestas a 
las preguntas que formulo anteriormente (sin negar la posibilidad de replantear las 
preguntas formuladas)',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('resumenseccion', 'textarea', array(
                    'label' => 'Haga un breve resumen de cada capitulo o parte de acuerdo con los subtítulos y secciones,
 haciendo a su vez una lista de las palabras clave que descubra en cada una',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('preguntas', 'textarea', array(
                    'label' => 'Señale que inquietudes, problemas o intereses con relación
a su proyecto podrían satisfacer con el contenido de esta lectura',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('recomendaciones', 'textarea', array(
                    'label' => 'En no más de 5 reglones formule una recomendación sobre
 la posible utilidad de esta lectura para su trabajo de investigación ',
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))


        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Lecturaconproposito'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_lecturaconproposito';
    }

}
