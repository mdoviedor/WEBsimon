<?php

namespace GS\ProyectosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MensajeenviadoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('asunto', 'text', array(
                    'label' => 'Asunto:',
                    'attr' => array('class' => 'form-control'),
                    'mapped' => false,
                    'required' => false,
                ))
//                ->add('para', 'entity', array(
//                    'label' => '* Para:',
//                    'expanded' => true,
//                    'multiple' => true,
//                    'required' => true,
//                    'attr' => array('type' => 'checkbox'),
//                    'class' => 'GSProyectosBundle:Usuario',
//                    'query_builder' => function(\GS\ProyectosBundle\Entity\UsuarioRepository $er) {
//                return $er->createQueryBuilder('u')
//                        ->orderBy('u.primernombre', 'ASC');
//            }) );
     ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'GS\ProyectosBundle\Entity\Mensajeenviado'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'gs_proyectosbundle_mensajeenviado';
    }

}
