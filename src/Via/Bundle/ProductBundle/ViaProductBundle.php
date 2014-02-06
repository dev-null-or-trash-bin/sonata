<?php

namespace Via\Bundle\ProductBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Via\Bundle\ResourceBundle\ViaResourceBundle;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

class ViaProductBundle extends Bundle
{
    /**
     * Return array with currently supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            ViaResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Via\Bundle\ProductBundle\Model\ProductInterface'         => 'via.model.product.class',
            'Via\Bundle\ProductBundle\Model\PropertyInterface'        => 'via.model.property.class',
            'Via\Bundle\ProductBundle\Model\ProductPropertyInterface' => 'via.model.product_property.class',
            'Via\Bundle\ProductBundle\Model\PrototypeInterface'       => 'via.model.prototype.class',
        );
    
        #$container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('via_product', $interfaces));
    
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Sylius\Bundle\ProductBundle\Model',
        );
    
        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array('doctrine.orm.entity_manager'), 'via_product.driver.doctrine/orm'));
    }
}
