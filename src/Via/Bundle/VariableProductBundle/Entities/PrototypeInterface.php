<?php

/*
 * This file is part of the Via package.
 *
 * (c); Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Bundle\VariableProductBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Via\Bundle\ProductBundle\Entity\PrototypeInterface as BasePrototypeInterface;

/**
 * Product prototype model with options support.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
interface PrototypeInterface extends BasePrototypeInterface
{
    /**
     * Returns all prototype options.
     *
     * @return OptionInterface[]
     */
    public function getOptions();

    /**
     * Sets all prototype options.
     *
     * @param Collection $options
     */
    public function setOptions(Collection $options);

    /**
     * Adds option.
     *
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option);

    /**
     * Removes option from prototype.
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Checks whether prototype has given option.
     *
     * @param OptionInterface $option
     *
     * @return Boolean
     */
    public function hasOption(OptionInterface $option);
}
