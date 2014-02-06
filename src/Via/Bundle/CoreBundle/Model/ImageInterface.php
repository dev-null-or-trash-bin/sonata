<?php
namespace Via\Bundle\CoreBundle\Model;

use Via\Bundle\ResourceBundle\Model\TimestampableInterface;

interface ImageInterface extends TimestampableInterface
{
    /**
     * @return boolean
     */
    public function hasFile();

    /**
     * @return null|\SplFileInfo
     */
    public function getFile();

    /**
     * @param \SplFileInfo $file
     */
    public function setFile(\SplFileInfo $file);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $path
     */
    public function setPath($path);
}
