<?php
namespace Via\Bundle\ApiUserBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class UserListener
{
    public function onPrePersist(GenericEvent $event) {}
    
    public function onPreUpdate(GenericEvent $event) {}
    
    public function onPreRemove(GenericEvent $event) {}
    
    public function onPostPersist(GenericEvent $event) {}
    
    public function onPostUpdate(GenericEvent $event) {}
    
    public function onPostRemove(GenericEvent $event) {}
}