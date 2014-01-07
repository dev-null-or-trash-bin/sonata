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
            ->add('vatPercent', 'text', array('label' => 'via.form.product.vat_percent'))
            ->add('name', 'text', array('label' => 'via.form.product.name'))
            ->add('shortDescription', 'text', array('label' => 'via.form.product.short_description'))
            ->add('description', 'textarea', array('label' => 'via.form.product.description')) 
            //if no type is specified, SonataAdminBundle tries to guess it
        ;
         $formMapper
                ->add('translations', 'a2lix_translations', array(
                    'by_reference' => false,
                    'locales' => array('en', 'de'),
                    'required' => false,                    // [2]
                    'fields' => array(                      // [3]
                        'description' => array(                   // [3.a]
                            'field_type' => 'textarea',                 // [4]
                            'label' => 'descript.',                     // [4]
                            'locale_options' => array(            // [3.b]
                                'en' => array(
                                    'label' => 'descripción'            // [4]
                                ),
                                'de' => array(
                                    'label' => 'beschreibung'            // [4]
                                )
                            )
                        )
                    )
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