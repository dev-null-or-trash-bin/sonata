<?php
namespace Via\Bundle\UserBundle\Model;

use Via\Bundle\UserBundle\Model\ViaEbayUserManagerInterface;

abstract class ViaEbayUserManager implements ViaEbayUserManagerInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function create()
    {
        return new $this->class;
    }
}