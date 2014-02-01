<?php
namespace Via\Bundle\ApiBundle\EventListener\Blackbox;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Via\Bundle\UserBundle\Model\BlackboxUserManagerInterface;
use Doctrine\Common\Util\Debug;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Via\Bundle\UserBundle\Model\BlackboxUserInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
use Via\Bundle\ApiBundle\Event\Blackbox\ResourceEvent;

class EnabledUserListener
{
    private $router;
    private $container;
    
    public function __construct(RouterInterface $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }
    
    public function onBeforeInitialize(ResourceEvent $event)
    {
        if (!$this->enabledUserExists())
        {
            $subject = $event->getSubject();
            $subject->getConfig()->set('request.params', array(
                'redirect.disable' => true
            ));
            #Debug::dump($subject, 4);
            #$request = $event->getRequest();
            #$referer = $request->headers->get('referer');
            
            #$event->setResponse(new RedirectResponse('sonata_admin_dashboard'));
        }
    }
    
    
    protected function enabledUserExists()
    {
        $session = $this->container->get('session');
        $platform = $session->get('blackbox');
        
        $user = $this->userManager->findOneBy(array('enabled' => 1, 'enviroment' => $platform['enviroment']));
        
        if (!$user instanceof BlackboxUserInterface)
        {
            return false;
        }
        
        return true;
    }
    
    public function setUserManager (BlackboxUserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }
}