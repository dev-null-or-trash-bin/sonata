<?php
namespace Via\Bundle\ResourceBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class LoadMetadataSubscriber implements EventSubscriber
{
    /**
     * @var array
     */
    protected $classes;

    /**
     * Constructor
     *
     * @param array $classes
     */
    public function __construct($classes)
    {
        $this->classes = $classes;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'loadClassMetadata'
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();
        $configuration = $eventArgs->getEntityManager()->getConfiguration();

        foreach ($this->classes as $class) {
            if (array_key_exists('model', $class) && $class['model'] === $metadata->getName()) {
                $metadata->isMappedSuperclass = false;
            }
        }

        if (!$metadata->isMappedSuperclass) {
            foreach (class_parents($metadata->getName()) as $parent) {
                $parentMetadata = new ClassMetadata(
                    $parent,
                    $configuration->getNamingStrategy()
                );
                if (in_array($parent, $configuration->getMetadataDriverImpl()->getAllClassNames())) {
                    $configuration->getMetadataDriverImpl()->loadMetadataForClass($parent, $parentMetadata);
                    if ($parentMetadata->isMappedSuperclass) {
                        foreach ($parentMetadata->getAssociationMappings() as $key => $value) {
                            if (ClassMetadataInfo::ONE_TO_MANY === $value['type'] || ClassMetadataInfo::ONE_TO_ONE === $value['type']) {
                                $metadata->associationMappings[$key] = $value;
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($metadata->getAssociationMappings() as $key => $value) {
                if ($value['type'] === ClassMetadataInfo::ONE_TO_MANY || $value['type'] === ClassMetadataInfo::ONE_TO_ONE) {
                    unset($metadata->associationMappings[$key]);
                }
            }
        }
    }
}
