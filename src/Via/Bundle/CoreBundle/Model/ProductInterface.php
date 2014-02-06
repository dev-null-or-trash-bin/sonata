<?php
namespace Via\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\Collection;
#use Sylius\Bundle\AddressingBundle\Model\ZoneInterface;
#use Sylius\Bundle\ShippingBundle\Model\ShippingCategoryInterface;
#use Sylius\Bundle\TaxationBundle\Model\TaxableInterface;
#use Sylius\Bundle\TaxationBundle\Model\TaxCategoryInterface;
use Via\Bundle\VariableProductBundle\Model\VariableProductInterface;

/**
 * Product interface.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface ProductInterface extends VariableProductInterface#, TaxableInterface
{
    /**
     * Get product SKU.
     *
     * @return string
     */
    public function getSku();

    /**
     * {@inheritdoc}
     */
    public function setSku($sku);

    /**
     * Get the variant selection method.
     *
     * @return string
     */
    public function getVariantSelectionMethod();

    /**
     * Set variant selection method.
     *
     * @param string $variantSelectionMethod
     */
    public function setVariantSelectionMethod($variantSelectionMethod);

    /**
     * Check if variant is selectable by simple variant choice.
     *
     * @return Boolean
     */
    public function isVariantSelectionMethodChoice();

    /**
     * Get pretty label for variant selection method.
     *
     * @return string
     */
    public function getVariantSelectionMethodLabel();

    /**
     * Gets product price.
     *
     * @return integer $price
     */
    public function getPrice();

    /**
     * Sets product price.
     *
     * @param float $price
     */
    public function setPrice($price);

    /**
     * Get product short description.
     *
     * @return string
     */
    public function getShortDescription();

    /**
     * Set product short description.
     *
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription);
    
    /**
     * Get all product images.
     *
     * @return Collection
     */
    public function getImages();

    /**
     * Get product main image.
     *
     * @return ImageInterface
     */
    public function getImage();
}
