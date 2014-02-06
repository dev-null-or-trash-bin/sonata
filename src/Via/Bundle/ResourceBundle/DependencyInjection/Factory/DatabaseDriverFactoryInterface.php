<?php
namespace Via\Bundle\ResourceBundle\DependencyInjection\Factory;

interface DatabaseDriverFactoryInterface
{
    public function create($prefix, $resourceName, array $classes, $templates = null);

    public function getSupportedDriver();
}