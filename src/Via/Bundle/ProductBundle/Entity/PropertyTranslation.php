<?php
namespace Via\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\Table(name="property_translation")
 */
class PropertyTranslation
{
    use ORMBehaviors\Translatable\Translation;
    
    /**
     * Presentation.
     * Displayed to user.
     *
     * @ORM\Column(name="presentation", type="string", length=255, nullable=false)
     */
    protected $presentation;

    public function getPresentation()
    {
        return $this->presentation;
    }

    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
        return $this;
    }
	
}