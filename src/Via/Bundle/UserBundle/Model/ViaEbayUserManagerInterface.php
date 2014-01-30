<?php
namespace Via\Bundle\UserBundle\Model;

interface ViaEbayUserManagerInterface
{
    /**
     * Creates an empty post instance
     *
     * @return Post
     */
    public function create();
    
    /**
     * Deletes a post
     *
     * @param PostInterface $post
     *
     * @return void
    */
    public function delete(ViaEbayUserInterface $user);
    
    /**
     * Finds one post by the given criteria
     *
     * @param array $criteria
     *
     * @return PostInterface
    */
    public function findOneBy(array $criteria);
    
    /**
     * Finds one post by the given criteria
     *
     * @param array $criteria
     *
     * @return PostInterface
    */
    public function findBy(array $criteria);
    
    /**
     * Returns the post's fully qualified class name
     *
     * @return string
    */
    public function getClass();
    
    /**
     * Save a post
     *
     * @param PostInterface $post
     *
     * @return void
    */
    public function save(ViaEbayUserInterface $user);
}