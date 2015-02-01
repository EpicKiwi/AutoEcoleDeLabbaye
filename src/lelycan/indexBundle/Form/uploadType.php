<?php

namespace lelycan\indexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class uploadType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description','textarea',array('label'=>'Modifications apportés','required'=>false))
            ->add('file',       'file',array('label'=>'Fichier'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'lelycan\indexBundle\Entity\upload'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lelycan_indexbundle_upload';
    }
}
