<?php

namespace Via\Bundle\CoreBundle\Model;

interface VariantImageInterface extends ImageInterface
{
    /**
     * Get variant.
     *
     * @return VariantInterface
     */
    public function getVariant();

    /**
     * Set the variant.
     *
     * @param VariantInterface $variant
     */
    public function setVariant(VariantInterface $variant = null);
}
