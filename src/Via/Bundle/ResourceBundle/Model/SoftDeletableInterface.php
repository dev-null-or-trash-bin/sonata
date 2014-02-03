<?php
namespace Via\Bundle\ResourceBundle\Model;

interface SoftDeletableInterface
{
    /**
     * Is item deleted?
     *
     * @return Boolean
     */
    public function isDeleted();

    /**
     * Get the time of deletion.
     *
     * @return \DateTime
     */
    public function getDeletedAt();

    /**
     * Set deletion time.
     *
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt);
}
