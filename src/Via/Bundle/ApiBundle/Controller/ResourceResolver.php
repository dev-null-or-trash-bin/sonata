<?php
namespace Via\Bundle\ApiBundle\Controller;

/**
 * Resource resolver.
 *
 */
class ResourceResolver
{
    /**
     * Get resources via repository based on the configuration.
     *
     * @param RepositoryInterface $repository
     * @param Configuration       $configuration
     */
    public function getResource($repository, Configuration $configuration, $defaultMethod, array $defaultArguments = array())
    {
        $callable = array($repository, $configuration->getMethod($defaultMethod));
        $arguments = $configuration->getArguments($defaultArguments);
        
        return call_user_func_array($callable, $arguments);
    }
}
