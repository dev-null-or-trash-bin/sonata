<?php
namespace Via\Bundle\ApiBundle\Controller;

use Guzzle\Http\Client;
use Via\Bundle\ApiBundle\Event\Blackbox\ResourceEvent;
use Doctrine\Common\Util\Debug;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceController extends RestController
{
    /**
     * Controller configuration.
     *
     * @var object Configuration
     */
    protected $configuration;
    
    protected $resolver;
    
    /**
     * Constructor.
     *
     * @param string $bundlePrefix
     * @param string $resourceName
     * @param string $templateNamespace
     * @param string $templatingEngine
     */
    public function __construct($bundlePrefix, $resourceName, $templateNamespace, $templatingEngine = 'twig')
    {
        $this->configuration = new Configuration($bundlePrefix, $resourceName, $templateNamespace, $templatingEngine);
        $this->configured = false;
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
    
    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }
    
    /**
     * Informs listeners that event data was used
     *
     * @param string       $name
     * @param Event|object $eventOrResource
     */
    public function dispatchEvent($name, $eventOrResource)
    {
        if (!$eventOrResource instanceof Event) {
            $name = $this->getConfiguration()->getEventName($name);
    
            $eventOrResource = new ResourceEvent($eventOrResource);
        }
        
        return $this->container->get('event_dispatcher')->dispatch($name, $eventOrResource);
    }
        
    protected function getResourceResolver()
    {
        if (null === $this->resolver) {
            $this->resolver = new ResourceResolver();
        }
    
        return $this->resolver;
    }
    
    protected function getService($name)
    {
        return $this->container->get($this->getConfiguration()->getServiceName($name));
    }
    
    public function renderResponse($templateName, array $parameters = array())
    {
        return $this->render($this->getConfiguration()->getTemplate($templateName), $parameters);
    }
}