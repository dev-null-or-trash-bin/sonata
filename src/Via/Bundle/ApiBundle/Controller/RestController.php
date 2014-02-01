<?php
namespace Via\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class RestController extends Controller
{
    /**
     * Guzzle client.
     *
     * @var object Guzzle\Http\Client
     */
    protected $client = null;

    public function getClient()
    {   
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }
    
    protected function dispatchCheckUserEvent($eventAction)
    {
        
	}

}