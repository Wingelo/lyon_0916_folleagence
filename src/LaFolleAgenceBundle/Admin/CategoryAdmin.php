<?php
/**
 * Created by PhpStorm.
 * User: axcel
 * Date: 17/10/16
 * Time: 11:39
 */
namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CategoryAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('categoryName', 'text');
		$formMapper->add('Posts',EntityType::class,array (
			'class' => 'LaFolleAgenceBundle:Post',
			'choice_label' => 'title',
			'expanded' => true,
			'multiple' => true,
			'by_reference' => true,

		)) ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('categoryName');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('categoryName');
    }

}
