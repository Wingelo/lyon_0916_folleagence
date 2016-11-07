<?php

namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class CommentAdmin
 * @package LaFolleAgenceBundle\Admin
 */

class CommentAdmin extends Admin
{


    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('author', null, array(
                'label' => 'Auteur'
            ))
            ->add('authorEmail', null, array(
                'label' => 'E-mail'
            ))
            ->addIdentifier('content', null, array(
                'label' => 'Message'
            ))
            ->add('date', null, array(
                'label' => 'Date de publication'
            ))
            ->addIdentifier('approved', null, array(
                'label' => 'Approuver'
            ))
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
                ))
            ->add('content', 'textarea',
                array(
                    'label' => 'Commentaire posté sur l\'article',
                    'disabled' => true
                ))
            ->add('myAnswer', 'textarea',
                array(
                    'label' => 'Répondre à ce commentaire',
					'required' => false
            ));
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

}

