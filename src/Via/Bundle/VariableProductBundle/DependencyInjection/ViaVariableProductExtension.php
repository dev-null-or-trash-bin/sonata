<?php

namespace Via\Bundle\VariableProductBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Via\Bundle\ResourceBundle\DependencyInjection\ViaResourceExtension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ViaVariableProductExtension extends ViaResourceExtension implements PrependExtensionInterface
{
    protected $configFiles = array(
        #'options',
        #'variants',
        
    );
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        #$configuration = new Configuration();
        #$config = $this->processConfiguration($configuration, $configs);

        #$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        #$loader->load('services.xml');
        
        $this->configDir = __DIR__.'/../Resources/config';
        $this->configure($configs, new Configuration(), $container);
    }
    
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        if (!$container->hasExtension('via_product')) {
            return;
        }
        
        $container->prependExtensionConfig('via_product', array(
            'classes' => array(
                'product' => array(
                    'entity' => 'Via\Bundle\VariableProductBundle\Entity\VariableProduct',
                    'form'  => 'Via\Bundle\VariableProductBundle\Form\Type\VariableProductType'
                ),
            ))
        );
    }
}
