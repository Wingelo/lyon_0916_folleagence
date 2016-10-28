<?php

namespace LaFolleAgenceBundle\Entity;

/**
 * LinkImage
 */
class LinkImage
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $path;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return LinkImage
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
