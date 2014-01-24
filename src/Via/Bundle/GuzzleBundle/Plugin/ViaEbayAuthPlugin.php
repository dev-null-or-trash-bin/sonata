<?php

namespace Via\Bundle\GuzzleBundle\Plugin;

use Guzzle\Common\Event;
use Guzzle\Common\Version;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
* Adds specified curl auth to all requests sent from a client. Defaults to CURLAUTH_BASIC if none supplied.
* @deprecated Use $client->getConfig()->setPath('request.options/auth', array('user', 'pass', 'Basic|Digest');
*/
class ViaEbayAuthPlugin implements EventSubscriberInterface
{
    protected $container;
    
    protected $securityContext;
    /**
     *
     */
    public function __construct()
    {
        
    }

    public static function getSubscribedEvents()
    {
        return array(
            'client.create_request' => array('onRequestCreate', 255),
            #'command.before_send' => array('onCommandBeforeSend', 255)
        );
    }

    /**
     * Add basic auth
     *
     * @param Event $event
     */
    public function onRequestCreate(Event $event)
    {
        $user = $this->securityContext->getToken()->getUser();
        $viaEbayUserName = $user->getViaebayUsername();
        $viaEbayPassword = $user->getViaebayPassword();
        $viaEbayToken = $user->getViaebayToken();
        
        $client = $this->container->get('via.guzzle.via_ebay.auth.client');
        $command = $client->getCommand('PostAuthentication', array('userName' => $viaEbayUserName, 'password' => $viaEbayPassword));
        $responseModel = $client->execute($command);
        
        $request = $event['request'];
        $request->setHeader('Cookie', $responseModel->getCookie());
        $request->setHeader('SubscriptionToken', $viaEbayToken);
        
        $cookieLifeTime = $this->container->getParameter('via.guzzle.cookie.life_time');
        
        
    }
    
    public function onCommandBeforeSend(Event $event)
    {
        
    }
    
    public function setServiceContainer (ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function setSecurityContext (SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }
}