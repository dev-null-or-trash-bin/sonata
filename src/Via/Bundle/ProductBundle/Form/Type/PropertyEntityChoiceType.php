<?php
namespace Via\Bundle\ProductBundle\Form\Type;

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
