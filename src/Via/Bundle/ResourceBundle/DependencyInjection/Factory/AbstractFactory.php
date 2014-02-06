<?php
namespace Via\Bundle\ResourceBundle\DependencyInjection\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class AbstractFactory implements DatabaseDriverFactoryInterface
{
    protected $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }
}