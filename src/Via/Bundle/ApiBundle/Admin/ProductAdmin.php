<?php
namespace Via\Bundle\ApiBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Via\Bundle\ProductBundle\Admin\ProductAdmin as BaseAdmin;

class ProductAdmin extends BaseAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
    }

    /**
     * Kinda Hackish methods to fix potential bug with SonataAdminBundle.
     * I have not
     * confirmed this is necessary but I've seen this implemented more than once.
     */
    public function prePersist($product)
    {
        parent::prePersist($product);
    }

    public function preUpdate($product)
    {
        parent::preUpdate($product);
    }
    
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
    }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);
    }
}