<?php

namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Class CommentAdmin
 * @package LaFolleAgenceBundle\Admin
 */

class CommentAdmin extends Admin
{

    // Fields to be shown on filter forms
    /*protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('author')
            ->add('authorEmail')
        ;
    }*/

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

    // Fields to be modified in back office
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('approved', CheckboxType::class,
                array(
                    'label' => 'Valider ce commentaire',
                    'required' => false
                ));
    }
}