<?php
namespace Via\Bundle\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    #protected $translationDomain = 'messages'; // default is 'messages'
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('stockAmount',
                    'number', array(
                                'label' => 'via.form.product.stock_amount',
                                'translation_domain' => 'messages',
             ))
            ->add('ean',
                    'text', array(
                            'label' => 'via.form.product.ean'
             ))
            ->add('price',
                    'money', array(
                                'label' => 'via.form.product.price'
             ))
            ->add('articleNumber',
                    'text', array(
                                'label' => 'via.form.product.article_number'
             ))
            ->add('vatPercent',
                    'number', array(
                                'label' => 'via.form.product.vat_percent'
             ))
            ->add('translations', 'a2lix_translations', array(
                'by_reference' => false,
                'locales' => array('de', 'en'),
                'label' => 'via.form.product.translations',
                'fields' => array(
                    'name' => array(
                        'field_type' => 'text',
                        'label' => 'via.form.product.name',
                        'required' => true,
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
            ))
        ;
         
        $formMapper->with('Property')
        /* ->add('properties', 'sonata_type_collection',
                array(
                    'by_reference' => false,
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'targetEntity' => 'Via\Bundle\PropertyBundle\Entity\Property',
                )) */
        
        /* ->add('properties',
            'collection',
            array(
                'type' => 'entity',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'options' => array(
                    'class' => 'ViaPropertyBundle:Property',
                    'property' => 'name',
                    'label' => false
                )
            )
        ) */
        
        ->add( 'properties', 'collection', array(
            'type' => new \Via\Bundle\ProductBundle\Form\Type\ProductPropertyType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false ))
        
        /* ->add('properties', 'sonata_type_collection',
            array(
                'by_reference' => false,
            ),
            array(
                'edit' => 'inline',
                'inline' => 'table',
                'allow_add' => true,
                'allow_delete' => true,
                'admin_code' => 'sonata.admin.product_property' # each has custom form configuration
            ))*/
        #->add('properties', 'via_property_choice')
       
        
        
        ->end()
        ;
    }
    
    /**
     * Kinda Hackish methods to fix potential bug with SonataAdminBundle. I have not
     * confirmed this is necessary but I've seen this implemented more than once.
     */
    public function prePersist($product)
    {
        #throw new \Exception('__METHOD__');
        $product->setProperties($product->getProperties());
    }
    
    public function preUpdate($product)
    {
        #throw new \Exception('__METHOD__');
        $product->setProperties($product->getProperties());
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
            ->add('price', null, array('label' => 'via.form.product.price'))
        ;
    }
    
}