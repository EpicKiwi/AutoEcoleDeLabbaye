<?php

namespace Abbaye\IndexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',		'text')
            ->add('date',		'date')
            ->add('description','textarea', array('required'=>false, 'attr'=>array('class'=>'EditeMoi')))
            ->add('tel',		'text', array('required'=>false))
            ->add('fax',		'text', array('required'=>false))
            ->add('adresse',	'text', array('required'=>false))
            ->add('email',		'text', array('required'=>false))
            ->add('file',		'file', array('required'=>false,'label'=>'Logo de l\'agence'))
            /* ->add('defaut'		'checkbox', array('required'=>false)) */
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Abbaye\IndexBundle\Entity\Agences'
        ));
    }

    public function getName()
    {
        return 'abbaye_indexbundle_agencestype';
    }
}
