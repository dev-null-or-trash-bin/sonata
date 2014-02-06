<?php
namespace Via\Bundle\CoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
#use Via\Bundle\AddressingBundle\Model\AddressInterface;
#use Via\Bundle\ResourceBundle\Model\TimestampableInterface;

interface UserInterface extends BaseUserInterface#, TimestampableInterface
{
    
}
