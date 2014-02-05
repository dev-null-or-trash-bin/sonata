<?php

namespace Via\Bundle\ResourceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ViaResourceExtension extends Extension
{
    protected $configFiles = array(
        'services',
    );
    /**
     * {@inheritDoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configDir = __DIR__.'/../Resources/config';

        list($config) = $this->configure($config, new Configuration(), $container);

        if (!isset($config['classes'])) return;
        
        $classes = $config['classes'];

        #$container->setParameter('via.controller.cart.class', $classes['cart']['controller']);

        #$container->setParameter('via.controller.cart_item.class', $classes['item']['controller']);
        #$container->setParameter('via.form.type.cart_item.class', $classes['item']['form']);

        #$container->setParameter('via.validation_group.cart', $config['validation_groups']['cart']);
        #$container->setParameter('via.validation_group.cart_item', $config['validation_groups']['item']);
    }
    
    public function configure(array $config, ConfigurationInterface $configuration, ContainerBuilder $container)
    {
        $processor = new Processor();
        $config    = $processor->processConfiguration($configuration, $config);
        
        $loader = new XmlFileLoader($container, new FileLocator($this->configDir));
        
        foreach ($this->configFiles as $filename) {
            $loader->load($filename.'.xml');
        }
        
        $classes = isset($config['classes']) ? $config['classes'] : array();
        
        $this->mapClassParameters($classes, $container);
        
        if ($container->hasParameter('via.config.classes')) {
            $classes = array_merge($classes, $container->getParameter('via.config.classes'));
        }

        $container->setParameter('via.config.classes', $classes);
        
        return array($config, $loader);
    }
    
    /**
     * Remap class parameters.
     *
     * @param array            $classes
     * @param ContainerBuilder $container
     */
    protected function mapClassParameters(array $classes, ContainerBuilder $container)
    {
        foreach ($classes as $model => $serviceClasses) {
            foreach ($serviceClasses as $service => $class) {
                $container->setParameter(sprintf('via.%s.%s.class', $service === 'form' ? 'form.type' : $service, $model), $class);
            }
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        if (!$container->hasExtension('via_order')) {
            return;
        }
    
        $container->prependExtensionConfig('via_order', array(
            'classes' => array(
                'order_item' => array(
                    'model' => 'Via\Bundle\CartBundle\Model\CartItem'
                ),
                'order' => array(
                    'model' => 'Via\Bundle\CartBundle\Model\Cart'
                )
            ))
        );
    }
}
