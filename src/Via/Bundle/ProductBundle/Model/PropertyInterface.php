<?php
namespace Via\Bundle\ProductBundle\Model;


interface PropertyInterface
{
    /**
     * Get internal name.
     * It's used when editing product.
     *
     * @return string
     */
    public function getName();
    
    /**
     * Set internal name.
     *
     * @param string $name
    */
    public function setName($name);
    
    /**
     * The name displayed to user.
     *
     * @return string
    */
    public function getPresentation();
    
    /**
     * Set presentation.
     *
     * @param string $presentation
    */
    public function setPresentation($presentation);
    
    /**
     * The type of the property.
     *
     * @return string
    */
    public function getType();
    
    /**
     * Set type of the property.
     *
     * @param string $type
    */
    public function setType($type);
}