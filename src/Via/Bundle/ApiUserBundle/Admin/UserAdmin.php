<?php
namespace Via\Bundle\ApiUserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Via\Bundle\ApiUserBundle\Event\UserEvent;
use Sonata\BlockBundle\Event\BlockEvent;

class UserAdmin extends Admin
{
    protected $eventDispatcher;
    
    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function prePersist($user)
    {
        $this->eventDispatcher->dispatch('via.api_user.prePersist', new UserEvent($user));
    }
    
    public function preUpdate($user)
    {
        $this->eventDispatcher->dispatch('via.api_user.preUpdate', new UserEvent($user));
    }
    
    public function preRemove($user)
    {
        $this->eventDispatcher->dispatch('via.api_user.preRemove', new UserEvent($user));
    }
    
    public function postPersist($user)
    {
        $this->eventDispatcher->dispatch('via.api_user.postPersist', new UserEvent($user));
    }
    
    public function postUpdate($user)
    {
        $this->eventDispatcher->dispatch('via.api_user.postUpdate', new UserEvent($user));
    }
    
    public function postRemove($user)
    {
        $this->eventDispatcher->dispatch('via.api_user.postRemove', new UserEvent($user));
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('username')
                ->add('token')
                
            ->end()
            // .. more info
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $this->eventDispatcher->dispatch('sonata.block.event.sonata.admin.form.list.top', new BlockEvent());
        $formMapper
            ->with('General')
                ->add('username')
                ->add('password')
                ->add('token', 'text', array('required' => false))
                ->add('enabled', 'checkbox', array('required' => false))
            ->end()
            // .. more info
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('username')
            ->add('token')
        ;
    }
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('token')
            ->add('enabled', null)
            #->add('enabled', null, array('editable' => true))
            ->add('createdAt')
            
        ;
    }
}
