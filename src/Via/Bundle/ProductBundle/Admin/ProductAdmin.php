<?php
namespace Via\Bundle\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
    // protected $translationDomain = 'messages'; // default is 'messages'
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $context = $this->getPersistentParameter('context');
        
        // tab properties
        $formMapper->with('via.tab.label.product',array(
        ))
        ->add('stockAmount', 'number', array(
            'label' => 'via.form.label.product.stock_amount',
            'translation_domain' => 'messages'
        ))
        ->add('ean', 'text', array(
            'label' => 'via.form.label.product.ean'
        ))
        ->add('price', 'money', array(
            'label' => 'via.form.label.product.price'
        ))
        ->add('articleNumber', 'text', array(
            'label' => 'via.form.label.product.article_number'
        ))
        ->add('vatPercent', 'number', array(
            'label' => 'via.form.label.product.vat_percent'
        ))
        ->add('translations', 'a2lix_translations', array(
            'by_reference' => false,
            'locales' => array(
                'de',
                'en'
            ),
            'label' => 'via.form.label.product.translations',
            'fields' => array(
                'name' => array(
                    'field_type' => 'text',
                    'label' => 'via.form.label.product.name',
                    'required' => true
                ),
                'shortDescription' => array(
                    'field_type' => 'text',
                    'label' => 'via.form.label.product.short_description'
                ),
                'description' => array(
                    'field_type' => 'textarea',
                    'label' => 'via.form.label.product.description'
                )
            )
        ));
        
        // tab properties
        $formMapper->with('via.tab.label.properties', array(
        ))
        ->add('properties', 'sonata_type_collection', array(
            'required' => false,
            'by_reference' => false,
            'label' => 'via.tab.label.properties',
            'type_options' => array('btn_add' => true, 'btn_delete' => true)
        ), array(
            'edit' => 'inline',
            'inline' => 'table',
            'allow_add' => true,
            'allow_delete' => true,
        ))
        
        ->end();
    }

    /**
     * Kinda Hackish methods to fix potential bug with SonataAdminBundle.
     * I have not
     * confirmed this is necessary but I've seen this implemented more than once.
     */
    public function prePersist($product)
    {
        $product->setProperties($product->getProperties());
    }

    public function preUpdate($product)
    {
        $product->setProperties($product->getProperties());
    }
    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('articleNumber', null, array(
            'label' => 'via.form.label.product.articleNumber'
        ))
//         ->add('name', null, array(
//             'label' => 'via.form.label.product.name'
//         ))
        ->add('ean', null, array(
            'label' => 'via.form.label.product.ean'
        ))
        ->add('stockAmount', null, array(
            'label' => 'via.form.label.product.stockAmount'
        ));
    }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', null, array(
            'label' => 'via.form.label.product.id'
        ))
        ->add('name', null, array(
                'label' => 'via.form.label.product.name',
                'route' => array(
                    'name' => 'edit'
                )
        ))
        ->add('price', null, array(
                'label' => 'via.form.label.product.price'
        ))
        ->add('stockAmount', null, array(
                'label' => 'via.form.label.product.stockAmount'
        ))
        
        // add custom action links
        ->add('_action', 'actions', array(
            'actions' => array(
                'show' => array(),
                'edit' => array(),
            ),
            'label' => 'via.form.label.custom_action'
        ))
        ;
    }
}