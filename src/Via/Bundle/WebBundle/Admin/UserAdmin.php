<?php
namespace Via\Bundle\WebBundle\Admin;

use Via\Bundle\UserBundle\Admin\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends BaseUserAdmin
{   
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
    
        $formMapper->with('FooBar');
        
        $formMapper->with('ViA-eBay')
            ->add('viaebay_user', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array()))        
        ;
    }
}
