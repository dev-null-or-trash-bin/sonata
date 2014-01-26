<?php
namespace Via\Bundle\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Via\Bundle\UserBundle\Entity\EnviromentTypes;

class ViaEbayUserAdmin extends Admin
{
    protected $baseRoutePattern = 'via-viaebay-user';
    
    protected function configureFormFields(FormMapper $formMapper)
    {   
        $formMapper->with('ViaEbay')
        ->add('name', null, array(
             
        ))
        ->add('username', null, array(
        	
        ))
        ->add('password', null, array(
        	
        ))
        ->add('token', null, array(
        	
        ))
        ->add('enabled', null, array(
             
        ))
        ->add('enviroment', 'choice', array(
            'label' => 'via.form.property.type',
            'choices' => EnviromentTypes::getChoices()
        ))
        ->add('reset', 'checkbox', array(
            'mapped' => false,
            'required' => false
        ))
        ->end();
    }
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', null, array(
            'label' => 'via.form.label.product.id'
        ))
        ->add('name', null, array(
            'label' => 'via.form.label.viaebay_user.name',            
        ))
        ->add('enviroment', null, array(
            'label' => 'via.form.label.viaebay_user.enviroment',
        ))
        ->add('enabled', null, array(
            'editable' => true,
            'label' => 'via.form.label.viaebay_user.enabled'
        ))
        
        // add custom action links
        ->add('_action', 'actions', array(
            'actions' => array(
                'show' => array(),
                'edit' => array(),
            ),
        ))
        ;
    }
    
    
}
