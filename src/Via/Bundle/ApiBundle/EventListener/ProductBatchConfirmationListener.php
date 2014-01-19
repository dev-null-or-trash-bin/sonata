<?php
namespace Via\Bundle\ApiBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class ProductBatchConfirmationListener
{
    public function onProductBatchConfrmation(GenericEvent $event)    
    {   
        $request = $event->getSubject();
        \Doctrine\Common\Util\Debug::dump($request, 6);
        
        sleep(10);
    }
}