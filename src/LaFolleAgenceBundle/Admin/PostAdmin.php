<?php


namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title','text',
                array(
                    'label' => 'Titre'
                ))
            ->add('link', 'text',
                array(
                    'label' => 'URL de l article'
                ))
            ->add('content', 'ckeditor',
                array('label' => 'Contenu'
                ))

            ->add('open_comment', CheckboxType::class,
                array(
                    'label' => 'Activer commentaire',
                    'required' => false
                ))

            ->add('statut', CheckboxType::class, array(
                'data' => false,
                'required' => false
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('title', null,
                array('label' => 'Titre'
            ))
            ->add('draft')
            ->add('date', null, array(
                'format' => 'Y-m-d H:i',
                'timezone' => 'America/New_York'
            ));
    }
}

