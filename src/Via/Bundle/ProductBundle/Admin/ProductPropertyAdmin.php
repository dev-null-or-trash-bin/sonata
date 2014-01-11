<?php
namespace Via\Bundle\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ProductPropertyAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        /* $formMapper
            ->add('property', 'entity', array(
                'class' => 'ViaPropertyBundle:Property',
                'property' => 'presentation',
                'label' => 'via.form.product_property.property'
        ))
        ->add('value', 'text', array(
            'label' => 'via.form.product_property.value'
        ))
        ;
            
        if (!$this->isChild()) {
            $formMapper
            ->add('product', 'entity', array(
                'class' => 'ViaProductBundle:Product',
                'property' => 'name',
                'label' => 'via.form.product_property.product'
            ));
        } */
        
        $formMapper
        ->add('property', 'sonata_type_model_list', array(), array(
            'link_parameters' => array('context' => 'default')
        ))
        ->add('value', 'text', array(
            'label' => 'via.form.product_property.value'
        ))        
        ;
    }
    
    protected function configureRoutes(RouteCollection $routes)
    {
        parent::configureRoutes($routes);
    
        if($this->hasParentFieldDescription())
        {
            $routes->remove('create');
        }
    }
    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('property', null, array('label' => 'via.form.product_property.property'))
        ->add('value', null, array('label' => 'via.form.product_property.value'))
        ;
    }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('id')
        ->add('presentation', null, array('label' => 'via.form.product_property.presentation'))
        ->add('value', null, array('label' => 'via.form.product_property.value'))
        ->add('product', null, array('label' => 'via.form.product_property.product'))
        ;
    }
}