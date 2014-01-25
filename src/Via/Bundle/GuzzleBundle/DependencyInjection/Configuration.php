<?php

namespace Via\Bundle\GuzzleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
   /**
    * Generates the configuration tree builder
    *
    *
    * @return TreeBuilder
    */
    public function getConfigTreeBuilder() {

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('via_guzzle');

        $rootNode->children()         
                ->arrayNode('sandbox')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('service_description')->defaultValue('%kernel.root_dir%/config/via/sandbox_webservices.json')->end()
                    ->end()
                ->end()
                
                ->arrayNode('live')
                    ->addDefaultsIfNotSet()
                     ->children()
                        ->scalarNode('service_description')->defaultValue('%kernel.root_dir%/config/via/live_webservices.json')->end()
                     ->end()
                ->end()
                ->arrayNode('cookie')
                    ->prototype('scalar')
                    ->end()
                ->end()

                ->arrayNode('headers')
                    ->prototype('scalar')
                    ->end()
                ->end()
                
                ->booleanNode('logging')->defaultValue(false)->end()
        ->end()
        
        ;

        return $treeBuilder;
    }
}
