<?php

namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;


/**
 * Class CommentAdmin
 * @package LaFolleAgenceBundle\Admin
 */

class CommentAdmin extends Admin
{

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('author')
            ->add('authorEmail')
            ->add('date')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('author')
            ->add('authorEmail')
            ->addIdentifier('content')
            ->add('date')
            ->addIdentifier('approved')
        ;
    }


    /*protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title','text',
                array(
                    'label' => 'Titre'
                ))
            ->add('link', 'text',
                array(
                    'label' => 'URL de l\'article'
                ))
            ->add('content', 'ckeditor',
                array('label' => 'Contenu'
                ))

        ;
    }*/
}