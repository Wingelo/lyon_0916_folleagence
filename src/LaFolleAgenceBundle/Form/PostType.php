<?php

namespace LaFolleAgenceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('link')
            ->add('publicationDate', 'datetime')
            ->add('content')
            ->add('openComment')
            ->add('statut')
            ->add('oneToMany')
            ->add('manyToMany')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LaFolleAgenceBundle\Entity\Post'
        ));
    }
}
