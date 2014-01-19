<?php
namespace Via\Bundle\ApiBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Via\Bundle\ProductBundle\Admin\ProductAdmin as BaseAdmin;
use Knp\Menu\ItemInterface as MenuItemInterface;

class ProductAdmin extends BaseAdmin
{
    protected $translationDomain = 'messages';
    /* protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (! $childAdmin && (! in_array($action, array(
            'edit'
        )) && ! in_array($action, array(
            'list'
        )))) {
            return;
        }
        
        $container = $this->getConfigurationPool()->getContainer();
        $apiUserRepository = $container->get('via_api_user.repository.user');
        $user = $apiUserRepository->findOneBy(array(
            'enabled' => '1'
        ));
        
        $menu->addChild('via_api_user.label.active_user', array());
    } */

//     protected function configureFormFields(FormMapper $formMapper)
//     {
//         parent::configureFormFields($formMapper);
//     }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();
        
        if (isset($actions['delete']))
        {
            //$actions['delete']['label'] = 'via.batch.action.delete';
        }
        
        $actions['sendToViaEbay'] = [
            'label' => 'via.batch.action.via_ebay',
            'template' => 'ViaApiBundle:CRUD:batch_confirmation.html.twig',
            'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
        ];
        
        return $actions;
    }

    /**
     * Kinda Hackish methods to fix potential bug with SonataAdminBundle.
     * I have not
     * confirmed this is necessary but I've seen this implemented more than once.
     */
//     public function prePersist($product)
//     {        
//         parent::prePersist($product);
//     }

//     public function preUpdate($product)
//     {        
//         parent::preUpdate($product);
//     }
    
    // Fields to be shown on filter forms
//     protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//     {   
//         parent::configureDatagridFilters($datagridMapper);
//     }
    
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {        
        parent::configureListFields($listMapper);
        $oldActions = $listMapper->get('_action');
        
        $customActions['actions'] = array(
            'via_ebay_action' => array(
                'template' => 'ViaApiBundle:ViaEbay:custom_action.html.twig',
                'label' => 'via_ebay_action',
                array(
                    "attr" => array(
                        "class" => "someCssClass"
                    )
                )
            )
        );
        
        $oldActions->mergeOptions($customActions);
    }
}