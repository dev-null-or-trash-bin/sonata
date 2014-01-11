<?php
namespace Via\Bundle\PropertyBundle\Form\Type;

class PropertyEntityChoiceType extends PropertyChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }
}
