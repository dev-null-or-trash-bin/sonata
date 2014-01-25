<?php

namespace Via\Bundle\GuzzleBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\Processor;

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
        
        $container->setParameter('via_guzzle.client.service_description.via_ebay.file', $config['sandbox']['service_description']);
        
        if($config['headers']) {
        
            $this->setUpHeaders($config['headers'], $container);
        }
        
        if($config['cookie']) {
        
            $this->setUpCookieLifeTime($config['cookie'], $container);
        }
    }
    
    protected function setUpHeaders(array $headers, ContainerBuilder $container) {
    
        $container->setParameter('via_guzzle.plugin.via_ebay.header.headers', $headers);
    }
    
    protected function setUpCookieLifeTime(array $cookies, ContainerBuilder $container) {
    
        $container->setParameter('via_guzzle.cookie.life_time', $cookies['life_time']);
        
    }
}
