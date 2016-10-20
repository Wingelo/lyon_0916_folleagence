<?php

// src/AppBundle/Admin/PostAdmin.php
namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;



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
            ->add('content', 'ckeditor', array(
                'config' => array(
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => array(
                        'instance' => 'default',
                        'homeFolder' => ''
                    )
                ),
            ))

            ->add('open_comment', 'checkbox',
                array(
                    'label' => 'Activer commentaire'
                ))
            ->add('statut', 'checkbox')


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
            ))
        ;
    }
}

