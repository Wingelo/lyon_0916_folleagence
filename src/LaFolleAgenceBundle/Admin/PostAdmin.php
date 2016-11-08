<?php


namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use LaFolleAgenceBundle\Entity\Post;

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
                    'label' => 'URL de l\'article',
					'required' => false,
					'disabled' => true
                ))
            ->add('content', 'ckeditor',
                array('label' => 'Contenu'
                ))

            ->add('open_comment', CheckboxType::class,
                array(
                    'label' => 'Activer les commentaires',
                    'required' => false
                ))

            ->add('statut', CheckboxType::class, array(
                'required' => false,
                'label' => 'Publication'
            ))
			->add('Categorys',EntityType::class,array (
				'class' => 'LaFolleAgenceBundle:Category',
				'choice_label' => 'category_name',
				'label' => 'Catégories',
				'expanded' => true,
				'multiple' => true,
				'by_reference' => true,
			)) ;
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
					  'label' => 'Activer les commentaires'
				  ))
			  ->addIdentifier('publicationDate', null,
				  array(
					  'label' => 'Date de publication',
                      'format' => 'd-m-Y-H:i:s'
				  ))
			  ;
	  }


}

