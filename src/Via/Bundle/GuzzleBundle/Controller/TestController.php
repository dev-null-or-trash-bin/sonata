<?php
namespace Via\Bundle\GuzzleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction($name = null)
    {
        $client = $this->get('via_guzzle.client.via_ebay');
        #$client->setSslVerification(false);
        #\Doctrine\Common\Util\Debug::dump($client, 3);
        #$loggerPlugin = $this->get('playbloom_guzzle.client.plugin.logger');
        #$client->addSubscriber($loggerPlugin);
        
        // advanced profiler for developement and debug, requires web_profiler to be enabled
        #$profilerPlugin = $this->get('playbloom_guzzle.client.plugin.profiler');
        #$client->addSubscriber($profilerPlugin);
        #$request = $client->post('http://sandbox.api.via.de/Authentication_JSON_AppService.axd/Login', array('Content-Type' => 'application/json'), array('userName' => '', 'password' => ''));
        #$request->send();
        $command = $client->getCommand('GetProducts');
        $responseModel = $client->execute($command);
        #echo $responseModel['status'];
        
        $command = $client->getCommand('GetCatalogs');
        $responseModel = $client->execute($command);
        
        return $this->render('ViaGuzzleBundle:Test:index.html.twig', array('name' => $name));
    }
}