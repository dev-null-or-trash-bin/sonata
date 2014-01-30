<?php
namespace Via\Bundle\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceController
{
    protected $templating;
    
    protected $router;
    
    protected $container;
    
    
    public function __construct(EngineInterface $templating, UrlGeneratorInterface $router, ContainerInterface $container)
    {
        $this->templating = $templating;
        $this->router = $router;
        $this->container = $container;
    }
    
    public function getRequest()
    {
        return $this->container->get('request');
    }
}