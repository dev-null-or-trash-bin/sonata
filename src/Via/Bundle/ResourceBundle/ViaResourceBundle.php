<?php

namespace Via\Bundle\ResourceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Via\Bundle\ResourceBundle\DependencyInjection\Factory\DoctrineORMFactory;
use Via\Bundle\ResourceBundle\DependencyInjection\Factory\DoctrineODMFactory;
use Via\Bundle\ResourceBundle\DependencyInjection\ViaResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ViaResourceBundle extends Bundle
{
    // Bundle driver list.
    const DRIVER_DOCTRINE_ORM         = 'doctrine/orm';
    const DRIVER_DOCTRINE_MONGODB_ODM = 'doctrine/mongodb-odm';
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    
        /** @var ViaResourceExtension $extension */
        $extension = $container->getExtension('via_resource');
        $extension->addDatabaseDriverFactory(new DoctrineORMFactory($container));
        $extension->addDatabaseDriverFactory(new DoctrineODMFactory($container));
    }
}
