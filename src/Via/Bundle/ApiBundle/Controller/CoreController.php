<?php
namespace Via\Bundle\ApiBundle\Controller;

use Guzzle\Http\Client;

use Doctrine\Common\Util\Debug;

class CoreController extends ServiceController
{
    /**
     * Controller configuration.
     *
     * @var object Configuration
     */
    protected $configuration;
    /**
     * Guzzle client.
     *
     * @var object Guzzle\Http\Client
     */
    protected $client;
    
    /**
     * Get configuration with the bound request.
     *
     * @return Configuration
     */
    public function getConfiguration()
    {
        $this->configuration->load($this->getRequest());
    
        return $this->configuration;
    }
    
    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }
    
    public function setClient (Client $client)
    {
        $this->client = $client;
    }
    
    public function getClient ()
    {
        return $this->client;
    }
}