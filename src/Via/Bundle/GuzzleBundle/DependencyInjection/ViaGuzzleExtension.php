<?php

namespace Via\Bundle\GuzzleBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\Processor;
use Doctrine\Common\Util\Debug;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ViaGuzzleExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configPath = implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'Resources', 'config'));
        $loader = new XmlFileLoader($container, new FileLocator($configPath));
        $loader->load('services.xml');
        
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);
        
        foreach ($config['clients'] as $client => $parameters)
        {   
            $this->setServiceDescription($client, $parameters, $container);
            $this->setUpHeaders($client, $parameters, $container);
            $this->setUpCookieLifeTime($client, $parameters, $container);
            $this->setEnviroment($client, $parameters, $container);
        }
    }
    
    protected function setUpHeaders($client, array $parameters, ContainerBuilder $container) 
    {    
        if (isset($parameters['headers'])) {
                $container->setParameter($this->getAlias().'.client.' .$client.'.headers', $parameters['headers']);
        }        
    }
    
    protected function setUpCookieLifeTime($client, array $parameters, ContainerBuilder $container) 
    {
        if (isset($parameters['cookie']['life_time'])) {
            $container->setParameter($this->getAlias().'.client.' .$client.'.cookie.life_time', $parameters['cookie']['life_time']);
        
        }
    }
    
    protected function setServiceDescription($client, array $parameters, ContainerBuilder $container) 
    {    
        if (isset($parameters['service_description'])) {
            foreach($parameters['service_description'] as $enviroment => $envSettings) 
            {
                $container->setParameter($this->getAlias().'.client' .$client.'.'.$enviroment.'.service_description', $envSettings);
            }
            $container->setParameter($this->getAlias().'.client.' .$client.'.service_description.file', $parameters['service_description'][$parameters['enviroment']]);
        }
    }
    
    protected function setEnviroment($client, array $parameters, ContainerBuilder $container) 
    {    
        if (isset($parameters['enviroment'])) {
            $container->setParameter($this->getAlias().'.client.' .$client.'.enviroment', $parameters['enviroment']);
        }
    }
}
