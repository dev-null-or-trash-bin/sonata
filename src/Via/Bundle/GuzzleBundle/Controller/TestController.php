<?php
namespace Via\Bundle\GuzzleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction($name = null)
    {
        $client = $this->get('via.guzzle.via_ebay.client');
        #$client->setSslVerification(false);
        
        #$loggerPlugin = $this->get('playbloom_guzzle.client.plugin.logger');
        #$client->addSubscriber($loggerPlugin);
        
        // advanced profiler for developement and debug, requires web_profiler to be enabled
        #$profilerPlugin = $this->get('playbloom_guzzle.client.plugin.profiler');
        #$client->addSubscriber($profilerPlugin);
        #$request = $client->post('http://sandbox.api.via.de/Authentication_JSON_AppService.axd/Login', array('Content-Type' => 'application/json'), array('userName' => '', 'password' => ''));
        #$request->send();
        $command = $client->getCommand('PostAuthentication', array('userName' => '232:via-ebay-veytonAPI', 'password' => '5iU94-e-xyEPjw_'));
        $responseModel = $client->execute($command);
        echo $responseModel['status'];
        
        #\Doctrine\Common\Util\Debug::dump($request->getCurlOptions(), 3);
        
        return $this->render('ViaGuzzleBundle:Test:index.html.twig', array('name' => $name));
    }
}