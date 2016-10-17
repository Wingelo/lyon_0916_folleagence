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
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title','text')
            ->add('content', 'textarea')
            ->add('open_comment', 'checkbox')
            ->add('statut', 'checkbox')
            ->add('publication_date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ))
            ->add('link', 'text')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('draft')
        ;
    }
}

