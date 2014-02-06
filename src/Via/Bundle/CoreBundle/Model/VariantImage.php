<?php

namespace Via\Bundle\CoreBundle\Model;

class VariantImage extends Image implements VariantImageInterface
{
    /**
     * The associated variant
     *
     * @var VariantInterface
     */
    protected $variant;

    /**
     * {@inheritdoc}
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * {@inheritdoc}
     */
    public function setVariant(VariantInterface $variant = null)
    {
        $this->variant = $variant;

        return $this;
    }
}
