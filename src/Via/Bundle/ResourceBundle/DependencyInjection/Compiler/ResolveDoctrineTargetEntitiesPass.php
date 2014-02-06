<?php
namespace Via\Bundle\ResourceBundle\DependencyInjection\Compiler;

use Via\Bundle\ResourceBundle\DependencyInjection\DoctrineTargetEntitiesResolver;
use Via\Bundle\ResourceBundle\ViaResourceBundle;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface
{
    private $interfaces;
    private $bundlePrefix;

    public function __construct($bundlePrefix, array $interfaces)
    {
        $this->bundlePrefix = $bundlePrefix;
        $this->interfaces = $interfaces;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (ViaResourceBundle::DRIVER_DOCTRINE_ORM === $this->getDriver($container)) {
            $resolver = new DoctrineTargetEntitiesResolver();
            $resolver->resolve($container, $this->interfaces);
        }
    }

    private function getDriver(ContainerBuilder $container)
    {
        return $container->getParameter(sprintf('%s.driver', $this->bundlePrefix));
    }
}
