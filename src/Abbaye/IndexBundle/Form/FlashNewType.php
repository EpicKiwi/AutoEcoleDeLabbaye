<?php

namespace Abbaye\IndexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlashNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu',		'text')
			->add('important',		'checkbox',array('required'=>false));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Abbaye\IndexBundle\Entity\FlashNew'
        ));
    }

    public function getName()
    {
        return 'abbaye_indexbundle_flashnewtype';
    }
}
