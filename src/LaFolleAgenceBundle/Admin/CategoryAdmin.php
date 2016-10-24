<?php

namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


/**
 * Class CategoryAdmin
 * @package LaFolleAgenceBundle\Admin
 */
class CategoryAdmin extends Admin
{
    /**
     * @param FormMapper $formMapper
     */
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

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('categoryName');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('categoryName');
    }

	public function postUpdate( $object){

		$this->preRemove($object);
		$this->postPersist($object);

	}


	public function postPersist($object){

		$em = $this->modelManager->getEntityManager($object);

		$em->getRepository('LaFolleAgenceBundle:Category')->AddLink($object);


	}

    public function preRemove ($object) {

		$em = $this->modelManager->getEntityManager($object);

		$em->getRepository('LaFolleAgenceBundle:Category')->deleteLink($object);

    }
}