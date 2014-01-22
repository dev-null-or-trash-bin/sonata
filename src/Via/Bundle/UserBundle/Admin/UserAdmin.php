<?php
namespace Via\Bundle\UserBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends BaseUserAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        
        $formMapper->with('ViaEbay')
        ->add('viaebay_username', null, array(
        	
        ))
        ->add('viaebay_password', null, array(
        	
        ))
        ->add('viaebay_token', null, array(
        	
        ))
        ->add('reset', 'checkbox', array(
            'mapped' => false,
            'required' => false
        ))
        ->end();
    }
}
