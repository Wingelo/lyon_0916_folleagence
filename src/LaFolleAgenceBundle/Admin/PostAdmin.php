<?php


namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Class PostAdmin
 * @package LaFolleAgenceBundle\Admin
 */
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
                'required' => false,
                'label' => 'Publication'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('title', null,
                array('label' => 'Titre'
            ))
            ->addIdentifier('statut', null,
                array(
                    'label' => 'Publication'
                ))
            ->addIdentifier('openComment', null,
                array(
                    'label' => 'Activer commentaire'
                ))
            ->addIdentifier('publicationDate', null,
                array(
                    'label' => 'Date de publication'
                ))
            ;
    }


}

