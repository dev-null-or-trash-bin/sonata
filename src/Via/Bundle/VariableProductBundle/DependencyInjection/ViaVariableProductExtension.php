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
        'options',
        'variants',
        
    );
    /**
     * {@inheritDoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        #$configuration = new Configuration();
        #$config = $this->processConfiguration($configuration, $configs);

        #$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        #$loader->load('services.xml');
        
        $this->configDir = __DIR__.'/../Resources/config/container';
        
        $config[0]['driver'] = $container->getParameter('via_product.driver');
        
        $this->configure($config, new Configuration(), $container, self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS | self::CONFIGURE_VALIDATORS);
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
                    'model' => 'Via\Bundle\VariableProductBundle\Model\VariableProduct',
                    'form'  => 'Via\Bundle\VariableProductBundle\Form\Type\VariableProductType'
                ),
            ))
        );
    }
}
