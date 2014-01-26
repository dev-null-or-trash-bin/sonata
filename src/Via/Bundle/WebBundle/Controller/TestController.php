<?php
namespace Via\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\DependencyInjection\ContainerAware;

class TestController extends ContainerAware
{
    public function indexAction($name = null)
    {        
        $client = $this->container->get('via_guzzle.client.via_ebay');
        $response = new StreamedResponse();
        
        $command = $client->getCommand('GetProducts');
        $responseModel = $client->execute($command);
        
        $list = $responseModel->get('d');
        $counter = count($list);
        
        #\Doctrine\Common\Util\Debug::dump($list);
        
        #die();
        $callback = function () use ($responseModel) {
            
            $list = $responseModel->get('d');
            $counter = count($list);
            
            $singlePercent = 100 / $counter; 
            $test = 1;
            foreach($list as $key => $value)
            {
                echo ($test * $singlePercent);
                ob_flush();
                flush();
                $test++;
            }
        };
        
        #$response->setCallback($callback);
        
        #return $response;
        
        
        #$client->setSslVerification(false);
        #\Doctrine\Common\Util\Debug::dump($client, 3);
        #$loggerPlugin = $this->get('playbloom_guzzle.client.plugin.logger');
        #$client->addSubscriber($loggerPlugin);
        
        // advanced profiler for developement and debug, requires web_profiler to be enabled
        #$profilerPlugin = $this->get('playbloom_guzzle.client.plugin.profiler');
        #$client->addSubscriber($profilerPlugin);
        #$request = $client->post('http://sandbox.api.via.de/Authentication_JSON_AppService.axd/Login', array('Content-Type' => 'application/json'), array('userName' => '', 'password' => ''));
        #$request->send();
        #$command = $client->getCommand('GetProducts');
        #$responseModel = $client->execute($command);
        #echo $responseModel['status'];
        
        #$command = $client->getCommand('GetCatalogs');
        #$responseModel = $client->execute($command);
        
        
        
        #\Doctrine\Common\Util\Debug::dump(count($list), 6);
        return $this->render('ViaGuzzleBundle:Test:index.html.twig', array('name' => $name));
    }
}