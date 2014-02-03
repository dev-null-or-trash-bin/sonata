<?php
namespace Via\Bundle\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ProductPropertyAdmin extends Admin
{
    protected $baseRoutePattern = 'via/product-property';
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('property', 'entity', array(
                'class' => 'ViaProductBundle:Property',
                'property' => 'presentation',
                'label' => 'via.form.label.product_property.property',
        ), array(
            'edit' => 'inline',
            'inline' => 'table',
            'allow_add' => true,
            'allow_delete' => true,
        ))
        ->add('value', 'text', array(
            'label' => 'via.form.label.product_property.value',
            'required' => true,
        ))
        ;
    }
        
    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('property', null, array('label' => 'via.form.label.product_property.property'))
        ->add('value', null, array('label' => 'via.form.label.product_property.value'))
        ;
    }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('id')
        ->add('presentation', null, array('label' => 'via.form.label.product_property.presentation'))
        ->add('value', null, array('label' => 'via.form.label.product_property.value'))
        ->add('product', null, array('label' => 'via.form.label.product_property.product'))
        ->add('_action', 'actions', array(
            'actions' => array(
                'view' => array(),
                'edit' => array(),
                #'new' => array(),
            ),
            'label' => 'via.form.label.custom_action'
        ))
        ;
    }
}