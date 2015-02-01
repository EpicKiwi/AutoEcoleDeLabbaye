<?php

namespace Abbaye\IndexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',		'text')
            ->add('contenu',	'textarea')
            ->add('prix',		'text')
            ->add('description','textarea', array('required'=>false, 'attr'=>array('class'=>'EditeMoi')))
            ->add('date',		'date', array('required'=>false))
			->add('agences',	'entity', array(	'class'		=> 'AbbayeIndexBundle:Agences',
													'property'	=> 'nom',
													'multiple'	=> false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Abbaye\IndexBundle\Entity\Tarifs'
        ));
    }

    public function getName()
    {
        return 'abbaye_indexbundle_tarifstype';
    }
}
