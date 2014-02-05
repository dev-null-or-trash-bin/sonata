<?php

namespace Via\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Via\Bundle\ResourceBundle\DependencyInjection\ViaResourceExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ViaProductExtension extends ViaResourceExtension
{
    protected $configFiles = array(
        #'products',
        #'properties',
        #'prototypes',
        'services'
    );
    
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configDir = __DIR__.'/../Resources/config';
    
        $this->configure($config, new Configuration(), $container);
    }
}
