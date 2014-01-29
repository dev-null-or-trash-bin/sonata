<?php
namespace Via\Bundle\ApiBundle\Controller\ViaEbay;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
#use Via\Bundle\ApiBundle\Controller\CoreController;
#use Guzzle\Http\Client;

class TestController extends Controller
{
    protected $client;
    
    public function __construct()
    {
        print(__METHOD__);
        $this->client = $this->container->get('via_guzzle.client.via_ebay');
    }
    
    public function indexAction($name = null)
    {
        #$config = $this->getConfiguration();
        #$criteria = $config->getCriteria();
        #$arguments = $config->getArguments();
        
        $command = $this->client->getCommand('GetProducts');
                
        return $this->render('ViaApiBundle:Test:index.html.twig', array('arguments' => $arguments));
    }
    
    public function setGuzzleClient ()
    {
        print('dknfclsdfc');
        $this->client = $client;
    }
}