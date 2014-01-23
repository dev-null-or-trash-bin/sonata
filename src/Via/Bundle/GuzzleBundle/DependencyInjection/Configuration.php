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
    * @var string $alias
    */
    protected $alias;

   /**
    * @var boolean $debug
    */
    protected $debug;

   /**
    * Constructor
    *
    * @author Florian Preusner
    * @version 1.0
    * @since 2013-10
    *
    * @param string $alias
    * @param boolean $debug
    */
    public function __construct($alias, $debug = false) {

        $this->alias = $alias;
        $this->debug = (boolean) $debug;
    }

   /**
    * Generates the configuration tree builder
    *
    * @author Florian Preusner
    * @version 1.0
    * @since 2013-10
    *
    * @return TreeBuilder
    */
    public function getConfigTreeBuilder() {

        $builder = new TreeBuilder();
        $builder->root($this->alias)
                    ->children()
                        ->arrayNode('sandbox')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('auth_url')->defaultValue('http://sandbox.api.via.de')->end()
                                ->scalarNode('auth_path')->defaultValue('Authentication_JSON_AppService.axd/Login')->end()
                            ->end()
                        ->end()
                        

                        ->arrayNode('headers')
                            ->prototype('scalar')
                            ->end()
                        ->end()

                        ->arrayNode('plugin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('via_ebay')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('username')->defaultFalse()->end()
                                        ->scalarNode('password')->defaultValue('')->end()
                                        ->scalarNode('token')->defaultValue('')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()

                        ->booleanNode('logging')->defaultValue($this->debug)->end()
                    ->end()
                ->end();

        return $builder;
    }
}
