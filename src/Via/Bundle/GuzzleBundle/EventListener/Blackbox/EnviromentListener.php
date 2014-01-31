<?php
namespace Via\Bundle\GuzzleBundle\EventListener\Blackbox;

use Via\Bundle\GuzzleBundle\Context\Blackbox\EnviromentContextInterface;
use Doctrine\Common\Util\Debug;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class EnviromentListener
{
    protected $enviromentContext;
    
    public function __construct(EnviromentContextInterface $enviromentContext)
    {
        print_r(__METHOD__ . '<br/>');
        $this->enviromentContext = $enviromentContext;
    }
    
    public function onKernelRequest (GetResponseEvent $event)
    {
        print_r(__METHOD__ . '<br/>');
        $request = $event->getRequest();
        $session = $request->getSession();
        
        $session->set('blackbox', array('enviroment' => $this->enviromentContext->getDefaultEnviroment()));
        $session->save();
    }
}