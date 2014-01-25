<?php
namespace Via\Bundle\GuzzleBundle\EventListener\ViaEbay;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Via\Bundle\GuzzleBundle\Storage\ViaEbay\Cookie as ViaEbayCookie;

class ResponseListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $request  = $event->getRequest();
    
        // get cookie
        $value = $request->cookies->get('viaebay');
        
        if (null === $value)
        {
            \Doctrine\Common\Util\Debug::dump($value);
            // create cookie
            $cookie = new Cookie('viaebay', ViaEbayCookie::getValue(), ViaEbayCookie::getExpireDate());
            // set cookie in response
            $response->headers->setCookie($cookie);
        }
    }
}