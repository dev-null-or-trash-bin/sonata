<?php
namespace Via\Bundle\BlackboxApiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Common\Util\Debug;

class PlaybloomCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $clients = $container->hasDefinition('guzzle.client');
    
        if (empty($clients)) {
            return;
        }
        
        $guzzleDefinition = $container->getDefinition('guzzle.client');
        $guzzleDefinition->addTag('playbloom_guzzle.client');
        
        if ($container->hasDefinition('misd_guzzle.log.adapter.monolog'))
        {
            #Debug::dump($container->getDefinition('misd_guzzle.log.adapter.monolog'));
        }
    }
}