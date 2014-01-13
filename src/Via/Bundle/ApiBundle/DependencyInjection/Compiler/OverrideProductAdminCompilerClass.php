<?php
namespace Via\Bundle\ApiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideProductAdminCompilerClass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('via_product.admin.product');
        \Doctrine\Common\Util\Debug::dump($definition);
        $definition->setClass('Via\Bundle\ApiBundle\Admin\ProductAdmin');
    }
}