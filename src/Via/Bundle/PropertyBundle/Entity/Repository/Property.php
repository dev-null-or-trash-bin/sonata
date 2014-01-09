<?php
namespace Via\Bundle\PropertyBundle\Entity\Repository;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Doctrine\ORM\EntityRepository;

class Property extends EntityRepository implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}