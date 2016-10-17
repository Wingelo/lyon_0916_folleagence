<?php
/**
 * Created by PhpStorm.
 * User: axcel
 * Date: 17/10/16
 * Time: 11:54
 */

namespace LaFolleAgenceBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('content', 'textarea')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {

    }
}