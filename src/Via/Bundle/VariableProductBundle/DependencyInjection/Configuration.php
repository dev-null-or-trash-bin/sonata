<?php

namespace Via\Bundle\VariableProductBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('via_variable_product');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultNull()->end()
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
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('variant')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Via\\Bundle\\VariableProductBundle\\Model\\Variant')->end()
                                ->scalarNode('controller')->defaultValue('Via\\Bundle\\VariableProductBundle\\Controller\\VariantController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\VariableProductBundle\\Form\\Type\\VariantType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('option')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Via\\Bundle\\VariableProductBundle\\Model\\Option')->end()
                                ->scalarNode('controller')->defaultValue('Via\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\VariableProductBundle\\Form\\Type\\OptionType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('option_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Via\\Bundle\\VariableProductBundle\\Model\\OptionValue')->end()
                                ->scalarNode('controller')->defaultValue('Via\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\VariableProductBundle\\Form\\Type\\OptionValueType')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
