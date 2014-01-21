<?php
namespace Via\Bundle\ApiBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class ProductBatchConfirmationListener
{
    public function onProductBatchConfrmation(GenericEvent $event)
    {
        $request = $event->getSubject();
        $allElements = $request->get('all_elements');
        
        if ($allElements != 'on')
            $productIds = $request->get('idx');
        
        \Doctrine\Common\Util\Debug::dump($allElements, 6);die();
        
        sleep(10);
    }
}