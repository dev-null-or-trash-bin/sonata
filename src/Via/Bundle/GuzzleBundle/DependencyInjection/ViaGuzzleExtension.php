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
        
        $this->setServiceDescription($config, $container);
        $this->setUpHeaders($config, $container);
        $this->setUpCookieLifeTime($config, $container);
        $this->setEnviroment($config, $container);
    }
    
    protected function setUpHeaders(array $config, ContainerBuilder $container) {
    
        foreach($config as $platform => $settings)
        {
            if ($settings['headers']) {
                $container->setParameter($this->getAlias(). '.' .$platform.'.plugin.header.headers', $settings['headers']);
            }
        }
    }
    
    protected function setUpCookieLifeTime(array $config, ContainerBuilder $container) {
    
        foreach($config as $platform => $settings)
        {
            if ($settings['cookie']['life_time']) {
                $container->setParameter($this->getAlias(). '.' .$platform.'.cookie.life_time', $settings['cookie']['life_time']);
            }
        }
    }
    
    protected function setServiceDescription(array $config, ContainerBuilder $container) {
    
        foreach($config as $platform => $settings)
        {
            if ($settings['service_description']) {
                foreach($settings['service_description'] as $enviroment => $envSettings)
                $container->setParameter($this->getAlias(). '.' .$platform. '.'.$enviroment.'.client.service_description', $envSettings);
            }
            $container->setParameter($this->getAlias(). '.' .$platform.'.client.service_description', $settings['service_description'][$settings['enviroment']]);
        }
    }
    
    protected function setEnviroment(array $config, ContainerBuilder $container) {
    
        foreach($config as $platform => $settings)
        {
            if ($settings['enviroment']) {
                $container->setParameter($this->getAlias(). '.' .$platform.'.client.enviroment', $settings['enviroment']);
            }
        }
    }
}
