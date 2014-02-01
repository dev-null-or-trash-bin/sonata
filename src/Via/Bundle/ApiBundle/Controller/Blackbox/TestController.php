<?php
namespace Via\Bundle\ApiBundle\Controller\Blackbox;
#use Symfony\Bundle\FrameworkBundle\Controller\Controller;
#use Symfony\Component\DependencyInjection\ContainerInterface;
use Via\Bundle\ApiBundle\Controller\ResourceController;
use Guzzle\Http\Client;
use Doctrine\Common\Util\Debug;
use Via\Bundle\ApiBundle\Event\Blackbox\ApiEvents as BlackboxApiEvents;
use Symfony\Component\EventDispatcher\GenericEvent;
use Via\Bundle\UserBundle\Model\BlackboxUserInterface;
use Via\Bundle\ApiBundle\Event\Blackbox\ResourceEvent;

class TestController extends ResourceController
{
    public function indexAction($name = null)
    {   
        $client = $this->getClient();           
        #Debug::dump($this, 3);die();
        $config = $this->getConfiguration();
        #$criteria = $config->getCriteria();
        $arguments = $config->getArguments();
        
        $command = $client->getCommand('GetProducts');
        $responseModel = $client->execute($command);
                
        return $this->renderResponse('index.html', array('arguments' => $arguments));
    }
    
    public function index(Client $client)
    {
        $event = $this->dispatchEvent(BlackboxApiEvents::CLIENT_BEFORE_INITIALIZE, new ResourceEvent($client));
        /* if (!$event->isStopped()) {
            $this->persistAndFlush($resource, 'update');
        } */
    
        return $event;
    }
}