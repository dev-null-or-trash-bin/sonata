<?php
namespace Via\Bundle\WebBundle\Admin\Extension;

use Sonata\AdminBundle\Event\AdminEventExtension;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Knp\Menu\ItemInterface as MenuItemInterface;

class ProductAdminExtension extends AdminEventExtension
{   
}