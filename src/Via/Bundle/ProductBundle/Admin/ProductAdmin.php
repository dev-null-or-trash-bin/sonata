<?php
namespace Via\Bundle\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('stockAmount', 'string', array('label' => 'via.form.product.stock_amount'))
            ->add('ean', 'string', array('label' => 'via.form.product.ean'))
            ->add('price', 'text', array('label' => 'via.form.product.price'))
            ->add('articleNumber', 'string', array('label' => 'via.form.product.article_number'))
            ->add('vatPercent', 'string', array('label' => 'via.form.product.vat_percent'))
            ->add('name', 'string', array('label' => 'via.form.product.name'))
            ->add('shortDescription', 'string', array('label' => 'via.form.product.short_description'))
            ->add('description', 'text', array('label' => 'via.form.product.description')) 
            //if no type is specified, SonataAdminBundle tries to guess it
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('articleNumber')
            ->add('ean')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('price')
        ;
    }   
    
}