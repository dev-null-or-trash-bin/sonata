<?php

namespace Via\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('via_product');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;
        $this->addClassesSection($rootNode);
        
        return $treeBuilder;
    }
    
    /**
     * Adds `classes` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('product')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('controller')->defaultValue('Via\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\ProductBundle\\Form\\Type\\ProductType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('property')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Via\\Bundle\\ProductBundle\\Model\\Property')->end()
                                ->scalarNode('controller')->defaultValue('Via\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\ProductBundle\\Form\\Type\\PropertyType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_property')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Via\\Bundle\\ProductBundle\\Model\\ProductProperty')->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\ProductBundle\\Form\\Type\\ProductPropertyType')->end()
                            ->end()
                        ->end()                        
                    ->end()
                ->end()
            ->end()
        ;
    }
}
