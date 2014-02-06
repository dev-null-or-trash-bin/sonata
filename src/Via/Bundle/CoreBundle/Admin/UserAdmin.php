<?php
namespace Via\Bundle\CoreBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends BaseUserAdmin
{
    protected $baseRoutePattern = 'via-user';
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
           
    }
}
