<?php

namespace Via\Bundle\WebBundle\DependencyInjection;

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
class ViaWebExtension extends Extension
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
        
        $sonataLayouts = $container->getParameter('sonata.admin.configuration.templates');
        $sonataLayouts['layout'] = 'ViaWebBundle::standard_layout.html.twig';        
        $container->setParameter('sonata.admin.configuration.templates', $sonataLayouts);        
    }
    
    public function setSonataAdmin(ContainerBuilder $container)
    {   
        
        $sonataDashBoardBlocks = $container->getParameter('sonata.admin.configuration.dashboard_blocks');
        $sonataDashBoardBlocks[] = array(
        	                       'position'   => 'right',
                                   'type'       => 'via_web.block.service.account',
                                   'settings'   => array()  
                                );
        
        $container->setParameter('sonata.admin.configuration.dashboard_blocks', $sonataDashBoardBlocks);
        
    }
    
    public function setSonataBlocks (ContainerBuilder $container)
    {
        $sonataBlocks = $container->getParameter('sonata_block.blocks');
        
        $sonataBlocks['via_web.block.service.account']['context'] = array('user');
        $sonataBlocks['via_web.block.service.account']['settings'] = array();
        $sonataBlocks['via_web.block.service.account']['cache'] = 'sonata.cache.noop';
        $sonataBlocks['via_web.block.service.account']['exception'] = array('filter' => 'ignore_block_exception');
        $container->setParameter('sonata_block.blocks', $sonataBlocks);
        
        $types = array();
        foreach ($sonataBlocks as $service => $settings) {
            $types[] = $service;
        }
        #$container->get('sonata.block.loader')->replaceArgument(0, $types);
    }
}
