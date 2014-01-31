<?php

namespace Via\Bundle\GuzzleBundle\Plugin\Blackbox;

use Guzzle\Common\Event;
use Guzzle\Common\Version;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Via\Bundle\GuzzleBundle\Storage\Blackbox\Cookie;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

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
    /**
     *
     */
    public function __construct()
    {
        
        #Debug::dump($user->getViaebayUser(), 5);die();
        /* if ($user instanceof UserInterface)
        {
            $viaebayUser = $user->getViaebayUser();
            $this->username = $viaebayUser->getUsername();
            $this->password = $viaebayUser->getPassword();
            $this->subscriptionToken = $viaebayUser->getToken();
        } */
    }

    public static function getSubscribedEvents()
    {
        return array(
            'client.create_request' => array('onRequestCreate', 255),
            #'command.before_send' => array('onCommandBeforeSend', 255)
        );
    }

    /**
     * Add ViaEbay Auth
     *
     * @param Guzzle\Common\Event $event
     */
    public function onRequestCreate(Event $event)
    {
        $enviroment = $this->container->getParameter('via_guzzle.blackbox.client.enviroment');
        $user = $this->userManager->findBy(array('enabled' => true, 'enviroment' => $enviroment));
        
        if ($user instanceof BlackboxUserInterface)
        {
            $this->username = $user->getUsername();
            $this->password = $user->getPassword();
            $this->subscriptionToken = $user->getToken();
            
            if (Cookie::getExpireDate() < new \DateTime())
            {
                $client = $this->container->get('via_guzzle.client.auth.via_ebay');
                $command = $client->getCommand('PostAuthentication', array('userName' => $this->username, 'password' => $this->password));
                $responseModel = $client->execute($command);
            
                $cookieValue = $responseModel->getCookie();
            
                $this->saveCookieData($cookieValue);
            }
            
            $request = $event['request'];
            $request->setHeader('SubscriptionToken', $this->subscriptionToken);
            $request->setHeader('Cookie', $cookieValue);
            
            return;
        }
    }
    
    private function saveCookieData ($value)
    {
        $lifeTime = $this->container->getParameter('via_guzzle.cookie.life_time');
        
        $currentDate = new \DateTime();
        $expireDate = $currentDate->add(new \DateInterval('PT'.$lifeTime.'S'));
        
        Cookie::setExpireDate($expireDate);
        Cookie::setValue($value);
    }
    
    public function onCommandBeforeSend(Event $event)
    {
        
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