<?php

namespace Via\Bundle\GuzzleBundle\Plugin\Blackbox;

use Guzzle\Common\Event;
use Guzzle\Common\Version;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Via\Bundle\GuzzleBundle\Storage\Blackbox\Cookie;
use Doctrine\Common\Util\Debug;
use Via\Bundle\UserBundle\Model\BlackboxUserManagerInterface;
use Via\Bundle\UserBundle\Model\BlackboxUserInterface;
/**
* Adds specified curl auth to all requests sent from a client. Defaults to CURLAUTH_BASIC if none supplied.
* @deprecated Use $client->getConfig()->setPath('request.options/auth', array('user', 'pass', 'Basic|Digest');
*/
class AuthPlugin implements EventSubscriberInterface
{
    protected $container;
    
    private $userManager;
        
    private $username;
    
    private $password;
    
    private $subscriptionToken;
    
    public static function getSubscribedEvents()
    {
        return array(            
            #'command.before_prepare' => array('onCommandBeforePrepare', 200),
            'request.before_send'   => array('onRequestBeforeSend', 200),
        );
    }
    
    public function onRequestBeforeSend (Event $event)
    {        
        $this->auth($event);
    }
    /**
     * Add ViaEbay Auth
     *
     * @param Guzzle\Common\Event $event
     */
    public function auth(Event $event)
    {
        $enviroment = $this->container->getParameter('via_guzzle.client.blackbox.enviroment');
        $user = $this->userManager->findOneBy(array('enabled' => true, 'enviroment' => $enviroment));
        #Debug::dump($user, 3);
        if ($user instanceof BlackboxUserInterface)
        {            
            $this->username = $user->getUsername();
            $this->password = $user->getPassword();
            $this->subscriptionToken = $user->getToken();
            
            if (Cookie::getExpireDate() < new \DateTime())
            {
                $client = $this->container->get('via_guzzle.client.blackbox.auth');
                $command = $client->getCommand('PostAuthentication', array('userName' => $this->username, 'password' => $this->password));
                $responseModel = $client->execute($command);
            
                $cookieValue = $responseModel->getCookie();
            
                $this->saveCookieData($cookieValue);
            }
            
            $request = $event['request'];
            
            $request->setHeader('SubscriptionToken', $this->subscriptionToken);
            $request->setHeader('Cookie', $cookieValue);
               
        }
        return $event;
    }
    
    private function saveCookieData ($value)
    {
        $lifeTime = $this->container->getParameter('via_guzzle.client.blackbox.cookie.life_time');
        
        $currentDate = new \DateTime();
        $expireDate = $currentDate->add(new \DateInterval('PT'.$lifeTime.'S'));
        
        Cookie::setExpireDate($expireDate);
        Cookie::setValue($value);
    }    
    
    public function setServiceContainer (ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function setUserManager (BlackboxUserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }
}