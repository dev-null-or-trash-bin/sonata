<?php
namespace Via\Bundle\ApiBundle\Controller\Blackbox;
#use Symfony\Bundle\FrameworkBundle\Controller\Controller;
#use Symfony\Component\DependencyInjection\ContainerInterface;
use Via\Bundle\ApiBundle\Controller\CoreController;
use Guzzle\Http\Client;

use Doctrine\Common\Util\Debug;
use Via\Bundle\ApiBundle\Event\Blackbox\UserEnabledEvent;
use Via\Bundle\ApiBundle\Event\Blackbox\ApiEvents;

class TestController extends CoreController
{
    public function indexAction($name = null)
    {
        #$event = new UserEnabledEvent();
        #$this->container->get('event_dispatcher')->dispatch(ApiEvents::USER_ENABLED, $event);
        
        #Debug::dump($this, 3);die();
        $config = $this->getConfiguration();
        #$criteria = $config->getCriteria();
        $arguments = $config->getArguments();
        
        #$client = $this->getClient();
        
        #$command = $client->getCommand('GetProducts');
        #$responseModel = $client->execute($command);
                
        return $this->templating->renderResponse('ViaApiBundle:Test:index.html.twig', array('arguments' => $arguments));
    }
}