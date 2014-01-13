<?php

namespace Via\Bundle\ApiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Via\Bundle\ApiBundle\DependencyInjection\Compiler\OverrideProductAdminCompilerClass;

class ViaApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new OverrideProductAdminCompilerClass());
    }
}
