<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TemaUsuarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('funcionusuario', 'entity', array(
                    'class' => 'GSProyectosBundle:Funcionusuario',
                    'property' => 'nombre',
                    'label'=>'* Función del usuario en el proyecto: ',
                    'attr'=>  array('class'=>'form-control')
                ))
//                ->add('tema', 'entity', array(
//                    'class' => 'GSProyectosBundle:Tema',
//                    'property' => 'titulo',
//                    'query_builder' => function(\GS\ProyectosBundle\Entity\TemaRepository $er) {
//                return $er->createQueryBuilder('u')
//                        ->where('u.estado = true');
//            },
//                ))
        // ->add('usuario')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\TemaUsuario'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_temausuario';
    }

}
