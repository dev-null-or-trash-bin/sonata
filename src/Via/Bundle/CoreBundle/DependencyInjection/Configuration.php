<?php

namespace Via\Bundle\CoreBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('via_core');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->cannotBeOverwritten()->isRequired()->cannotBeEmpty()->end()
                ->arrayNode('from_email')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('address')->defaultValue('webmaster@example.com')->cannotBeEmpty()->end()
                        ->scalarNode('sender_name')->defaultValue('webmaster')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('order_confirmation')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->booleanNode('enabled')->defaultFalse()->end()
                        ->scalarNode('template')->defaultValue('ViaWebBundle:Frontend/Email:orderConfirmation.html.twig')->end()
                        ->arrayNode('from_email')
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('address')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('sender_name')->isRequired()->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
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
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('entity')->defaultValue('Via\\Bundle\\CoreBundle\\Entity\\User')->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\CoreBundle\\Form\\Type\\UserType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('group')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('entity')->defaultValue('Via\\Bundle\\CoreBundle\\Entity\\Group')->end()
                                ->scalarNode('form')->defaultValue('Via\\Bundle\\CoreBundle\\Form\\Type\\GroupType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('variant_image')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Via\\Bundle\\CoreBundle\\Model\\VariantImage')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
