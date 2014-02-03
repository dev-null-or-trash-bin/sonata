<?php

namespace Via\Bundle\BlackboxApiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Via\Bundle\BlackboxApiBundle\DependencyInjection\Compiler\PlaybloomCompilerPass;

class ViaBlackboxApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    
        $container->addCompilerPass(new PlaybloomCompilerPass());
    }
}
