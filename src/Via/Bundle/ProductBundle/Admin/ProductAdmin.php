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
            ->add('stockAmount', 'number', array('label' => 'via.form.product.stock_amount'))
            ->add('ean', 'text', array('label' => 'via.form.product.ean'))
            ->add('price', 'money', array('label' => 'via.form.product.price'))
            ->add('articleNumber', 'text', array('label' => 'via.form.product.article_number'))
            ->add('vatPercent', 'number', array('label' => 'via.form.product.vat_percent'))
            //if no type is specified, SonataAdminBundle tries to guess it
        ;
         $formMapper
                ->add('translations', 'a2lix_translations', array(
                    'by_reference' => false,
                    'locales' => array('en', 'de'),
                    'required' => false,
                    'label' => 'via.form.product.translations',
                    'fields' => array(
                        'name' => array(
                            'field_type' => 'text',
                            'label' => 'via.form.product.name',
                        ),
                        'shortDescription' => array(
                            'field_type' => 'text',
                            'label' => 'via.form.product.short_description',
                        ),
                        'description' => array(
                            'field_type' => 'textarea',
                            'label' => 'via.form.product.description',
                        ),
                    ),
                ));
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