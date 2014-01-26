<?php
namespace Via\Bundle\WebBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Via\Bundle\ProductBundle\Admin\ProductAdmin as BaseAdmin;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class ProductAdmin extends BaseAdmin
{   
    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();
        
        $actions['send-to-viaebay-batch'] = [
            'label' => 'via.batch.action.via_ebay',
            'template' => 'ViaWebBundle:CRUD:batch_confirmation.html.twig',
            'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
        ];
        
        return $actions;
    }    
    
    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('send-to-viaebay-batch');
        $collection->add('send-to-viaebay-single', $this->getRouterIdParameter().'/viaebay/api');
    }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {        
        parent::configureListFields($listMapper);
        $oldActions = $listMapper->get('_action');
        
        $customActions['actions'] = array(
            'send-to-viaebay-single' => array(
                'template' => 'ViaWebBundle:Button:send_to_viaebay_button.html.twig',
                'label' => 'via_web.label.via_ebay.action',                
            )
        );
        
        $oldActions->mergeOptions($customActions);
    }
}