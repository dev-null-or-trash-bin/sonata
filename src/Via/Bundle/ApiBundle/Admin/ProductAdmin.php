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
    
    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();
        
        $actions['sendToViaEbay']=[
            'label'            => $this->trans('via.batch.action.via_ebay', array(), 'SonataAdminBundle'),
            'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
        ];
        
        return $actions;
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
        $oldActions = $listMapper->get('_action');
        #\Doctrine\Common\Util\Debug::dump($oldActions->getOptions());
        #\Doctrine\Common\Util\Debug::dump('######################################');
        $customActions['actions'] = array(
                                        'via_ebay_action' => array(
                                            'template' => 'ViaApiBundle:ViaEbay:custom_action.html.twig',
                                            'label' => 'via_ebay_action',
                                             array("attr" => array("class" => "someCssClass"))
                         ));
        #\Doctrine\Common\Util\Debug::dump($oldActions, 3);
        $oldActions->mergeOptions($customActions);
        
        #$listMapper->remove('template');
        #\Doctrine\Common\Util\Debug::dump($oldActions->getOptions());
    }
}