<?php

namespace Via\Bundle\ResourceBundle\DependencyInjection;

use Via\Bundle\ResourceBundle\DependencyInjection\Factory\DatabaseDriverFactoryInterface;
use Via\Bundle\ResourceBundle\DependencyInjection\Factory\ResourceServicesFactory;
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
    const CONFIGURE_LOADER     = 1;
    const CONFIGURE_DATABASE   = 2;
    const CONFIGURE_PARAMETERS = 4;
    const CONFIGURE_VALIDATORS = 8;
    
    protected $configFiles = array(
        'services',
    );
    /**
     * {@inheritDoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configDir = __DIR__.'/../Resources/config/container';

        list($config) = $this->configure($config, new Configuration(), $container);
        
        if (isset($config['resources'])) {
            $this->createResourceServices($config['resources']);
        }
    }
    
    public function configure(array $config, ConfigurationInterface $configuration, ContainerBuilder $container, $configure = self::CONFIGURE_LOADER)
    {
        $processor = new Processor();
        $config    = $processor->processConfiguration($configuration, $config);
        
        $loader = new XmlFileLoader($container, new FileLocator($this->configDir));
        
        foreach ($this->configFiles as $filename) {
            $loader->load($filename.'.xml');
        }
        
        if ($configure & self::CONFIGURE_DATABASE) {
            $this->loadDatabaseDriver($config['driver'], $loader, $container);
        }
        
        $classes = isset($config['classes']) ? $config['classes'] : array();

        if ($configure & self::CONFIGURE_PARAMETERS) {
            $this->mapClassParameters($classes, $container);
        }
        
        if ($container->hasParameter('via.config.classes')) {
            $classes = array_merge($classes, $container->getParameter('via.config.classes'));
        }

        $container->setParameter('via.config.classes', $classes);
        
        return array($config, $loader);
    }
    
    /**
     * Adds a factory that is able to handle a specific database driver type
     *
     * @param $factory
     */
    public function addDatabaseDriverFactory(DatabaseDriverFactoryInterface $factory)
    {
        $this->factories[$factory->getSupportedDriver()] = $factory;
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
     * Load bundle driver.
     *
     * @param string                $driver
     * @param XmlFileLoader         $loader
     * @param null|ContainerBuilder $container
     *
     * @throws \InvalidArgumentException
     */
    protected function loadDatabaseDriver($driver, XmlFileLoader $loader, ContainerBuilder $container = null)
    {
        $bundle = str_replace(array('Extension', 'DependencyInjection\\'), array('Bundle', ''), get_class($this));
        if (!in_array($driver, call_user_func(array($bundle, 'getSupportedDrivers')))) {
            throw new \InvalidArgumentException(sprintf('Driver "%s" is unsupported by %s.', $driver, basename($bundle)));
        }
    
        $loader->load(sprintf('driver/%s.xml', $driver));
    
        if (null !== $container) {
            $container->setParameter($this->getAlias().'.driver', $driver);
            $container->setParameter($this->getAlias().'.driver.'.$driver, true);
        }
    }
    
    /**
     * @param array $configs
     * @throws \InvalidArgumentException
     */
    private function createResourceServices(array $configs)
    {
        foreach ($configs as $name => $config) {
            list($prefix, $resourceName) = explode('.', $name);
    
            $factory = $this->getFactoryForDriver($config['driver']);
            if (!$factory) {
                throw new \InvalidArgumentException(sprintf('Driver "%s" is unsupported, no factory exists for creating services', $config['driver']));
            }
    
            $factory->create($prefix, $resourceName, $config['classes'], array_key_exists('templates', $config) ? $config['templates'] : null);
        }
    }
    
    /**
     * @param $driver
     * @return mixed
     */
    private function getFactoryForDriver($driver)
    {
        if (isset($this->factories[$driver])) {
            return $this->factories[$driver];
        }
    }
    
    
}
