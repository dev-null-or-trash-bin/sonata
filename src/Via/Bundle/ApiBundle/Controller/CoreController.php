<?php
namespace Via\Bundle\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Guzzle\Http\Client;

use Doctrine\Common\Util\Debug;

abstract class CoreController extends Controller
{
    /**
     * Controller configuration.
     *
     * @var Configuration
     */
    protected $configuration;
    protected $parameters;
    protected $client;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->configuration = new Configuration();
    }
    
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
    
    
}