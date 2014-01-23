<?php

namespace Via\Bundle\GuzzleBundle\Plugin;

use Guzzle\Common\Event;
use Guzzle\Common\Version;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Adds specified curl auth to all requests sent from a client. Defaults to CURLAUTH_BASIC if none supplied.
* @deprecated Use $client->getConfig()->setPath('request.options/auth', array('user', 'pass', 'Basic|Digest');
*/
class ViaEbayAuthPlugin implements EventSubscriberInterface
{
    /**
     * 
     */
    public function __construct()
    {
        
    }

    public static function getSubscribedEvents()
    {
        return array('client.create_request' => array('onRequestCreate', 255));
    }

    /**
     * Add basic auth
     *
     * @param Event $event
     */
    public function onRequestCreate(Event $event)
    {        
        #\Doctrine\Common\Util\Debug::dump($event, 3);#die(__METHOD__);
    }
}