<?php
namespace Via\Bundle\ProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Model
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