<?php

namespace Via\Bundle\VariableProductBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Via\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Via\Bundle\ResourceBundle\ViaResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ViaVariableProductBundle extends Bundle
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
            'Via\Bundle\VariableProductBundle\Model\VariantInterface'     => 'via.model.variant.class',
            'Via\Bundle\VariableProductBundle\Model\OptionInterface'      => 'via.model.option.class',
            'Via\Bundle\VariableProductBundle\Model\OptionValueInterface' => 'via.model.option_value.class',
        );
    
        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('via_product', $interfaces));
    
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Via\Bundle\VariableProductBundle\Model',
        );
    
        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array('doctrine.orm.entity_manager'), 'sylius_product.driver.doctrine/orm'));
    }
}
